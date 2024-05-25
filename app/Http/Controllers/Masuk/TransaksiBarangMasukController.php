<?php

namespace App\Http\Controllers\Masuk;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gudang\SisaTransaksiController;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\SatuanBarang;
use App\Models\Stok;
use App\Models\Supplier;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransaksiBarangMasukController extends Controller
{
    public function index(Request $request)
    {
        try {
            $jumlah_supplier = Supplier::count();
            $kode_supplier = "SP" . sprintf("%03d", $jumlah_supplier + 1);
            $jumlah_barang = Barang::count();
            $kode_barang = "BR" . sprintf("%03d", $jumlah_barang + 1);

            $last_code = TransaksiPembelian::where(DB::RAW("substring(created_at,1,10)"), date('Y-m-d'))->count();
            if (!empty($request->edit)) {
                $last_insert = TransaksiPembelian::where('Nota', $request->edit)->first();
                $mode_edit = true;
            } else {
                $last_insert = TransaksiPembelian::where('status', 0)->first();
                $mode_edit = false;
            }
            if (!empty($last_insert)) {
                $code = $last_insert->Nota;
                $tanggal_transaksi = $last_insert->TglNota;
                $supplier_id = $last_insert->KdSuplier;
            } else {
                $code = "PBK" . date('dmy') . sprintf("%03d", $last_code + 1);
                $tanggal_transaksi = date('Y-m-d');
                $supplier_id = null;
            }

            $last_details = TransaksiPembelianDetail::with('transaksi_pembelian')->whereRelation('transaksi_pembelian', 'Nota', $code)->get();

            return view('pembelian.pembelian_khusus.index', [
                "barang" => Barang::get(),
                "code" => $code,
                "mode_edit" => $mode_edit,
                "supplier_id" => $supplier_id,
                "suppliers" => Supplier::get(),
                "kode_supplier" => $kode_supplier,
                "kode_barang" => $kode_barang,
                "tanggal_transaksi" => $tanggal_transaksi,
                "detail_pembelian_khusus" => $last_details
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $from_date_value = $request->from ?? date('Y-m-01');
            $to_date_value = $request->to ?? date('Y-m-d');
            $edit = !empty($request->edit) ? true : false;
            $data = DB::table('pembelian as a')
                ->leftJoin('supplier as c', 'c.KdSuplier', 'a.KdSuplier')
                ->whereBetween('TglNota', [$from_date_value, $to_date_value])
                ->where('a.status', '!=', 0)
                ->select(
                    'a.*',
                    'c.NmSuplier as suppliers',
                )
                ->get();


            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($item) use ($edit) {
                    $btn = '';
                    if (($item->status == 1 || $item->status == 3)) {
                        $btn .= '<button class="btn btn-danger btn-xs me-1" id="btn_delete" data-bs-toggle="modal" onclick="modal_hapus(' . $item->id . ', 1)" data-id="' . $item->id . '" data-bs-target="#modalDeleteConfirm"> <i class="fa fa-trash"></i></button>';
                    }
                    if (($item->status == 1 || $item->status == 3)) {
                        $btn .= '<a href="' . url('pembelian?edit=') . $item->Nota . '" class="btn btn-warning btn-xs me-1"> <i class="fa fa-pencil"></i></a>';
                    }

                    $btn .= '<button type="button" class="btn btn-info btn-xs details-control me-1" data-id=' . $item->id . '> <i class="fa fa-search"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function simpan(Request $request)
    {
        try {
            $data = [
                "Nota" => $request->kode,
                "TglNota" => $request->tanggal_transaksi,
                "KdSuplier" => $request->supplier_id,
                "status" => 1,
            ];
            TransaksiPembelian::where('Nota', $request->kode)->update($data);
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function simpan_detail(Request $request)
    {
        $data = [
            "TglNota" => $request->tanggal_transaksi,
            "KdSuplier" => $request->supplier_id,
        ];

        $cek = TransaksiPembelian::where('Nota', $request->kode)->first();

        if (!empty($cek)) {
            TransaksiPembelian::where('Nota', $request->kode)->update($data);
            $transaksi_pembelian_id = $cek->id;
        } else {
            $data['Nota'] = $request->kode;
            $data['status'] = 0;
            $val = TransaksiPembelian::create($data);
            $transaksi_pembelian_id = $val->id;
        }

        $data_detail = [
            "Nota" => $transaksi_pembelian_id,
            "KdObat" => $request->barang_id,
            "Jumlah" => $request->qty,
        ];

        $insert = TransaksiPembelianDetail::create($data_detail);

        $get_barang = Barang::where('KdObat', $request->barang_id)->first();
        Barang::where('KdObat', $request->barang_id)->update(['stok' => $get_barang->Stok + $request->qty]);

        if ($insert) {
            $res = [
                'status' => true,
            ];
        } else {
            $res = [
                'status' => false,
            ];
        }

        return response()->json($res);
    }

    public function data_detail(Request $request)
    {
        $detail = TransaksiPembelian::where('Nota', $request->kode)->first();
        $last_details = TransaksiPembelianDetail::where('Nota', $detail->id)->get();

        return response()->json(['data' => $last_details]);
    }

    public function data_table_detail(Request $request)
    {
        $data = TransaksiPembelianDetail::with(['transaksi_pembelian'])->where('Nota', $request->id)->get();

        return view('pembelian.pembelian_khusus.detail', compact('data'));
    }

    public function edit(Request $request)
    {
        $detail = TransaksiPembelianDetail::with('transaksi_pembelian')->where('id', $request->id)->first();
        $data = [
            'data' => $detail,
            'barang' => Barang::get(),
        ];
        return view('pembelian.pembelian_khusus.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $pembelian_detail = TransaksiPembelianDetail::where('id', $id)->first();

            $get_barang = Barang::where('id', $pembelian_detail->barang_id)->first();
            Barang::where('id', $request->barang_id)->update(['stok' => $get_barang->stok - $pembelian_detail->qty, 'updated_by' => auth()->user()->id]);

            $data_detail = [
                "barang_id" => $request->barang_id,
                "harga" => replace_nominal($request->harga),
                "qty" => $request->qty,
            ];
            TransaksiPembelianDetail::where('id', $id)->update($data_detail);

            $data_stok = [
                'barang_id' => $request->barang_id,
                'stok_awal' => 0,
                'masuk' => $request->qty,
                'harga_masuk' => replace_nominal($request->harga),
                'keluar' => 0,
                'harga_keluar' => replace_nominal($request->harga),
                'stok_akhir' => $request->qty,
                'updated_by' => auth()->user()->id
            ];

            Stok::where('jenis', 1)->where('transaksi_detail_id', $id)->update($data_stok);

            $get_barang = Barang::where('id', $request->barang_id)->first();
            Barang::where('id', $request->barang_id)->update(['stok' => $get_barang->stok + $request->qty, 'updated_by' => auth()->user()->id]);
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function hapus(Request $request)
    {
        try {
            $detail = TransaksiPembelianDetail::where('id', $request->id)->first();
            if (!empty($request->jenis)) {
                TransaksiPembelian::where('id', $detail->transaksi_masuk_id)->delete();
                TransaksiPembelianDetail::where('transaksi_masuk_id', $detail->transaksi_masuk_id)->delete();
            } else {
                TransaksiPembelianDetail::where('id', $request->id)->delete();
            }
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }
}
