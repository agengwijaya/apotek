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
            $jumlah_jenis_barang = JenisBarang::count();
            $kode_jenis_barang = "JB" . sprintf("%03d", $jumlah_jenis_barang + 1);
            $jumlah_barang = Barang::count();
            $kode_barang = "BR" . sprintf("%03d", $jumlah_barang + 1);

            $last_code = TransaksiPembelian::where(DB::RAW("substring(created_at,1,10)"), date('Y-m-d'))->count();
            if (!empty($request->edit)) {
                $last_insert = TransaksiPembelian::where('id', $request->edit)->first();
                $mode_edit = true;
            } else {
                $last_insert = TransaksiPembelian::where('status', 0)->where('created_by', auth()->user()->id)->first();
                $mode_edit = false;
            }
            if (!empty($last_insert)) {
                $code = $last_insert->kode;
                $tanggal_transaksi = $last_insert->tanggal_transaksi;
                $supplier_id = $last_insert->supplier_id;
            } else {
                $code = "PBK" . date('dmy') . sprintf("%03d", $last_code + 1);
                $tanggal_transaksi = date('Y-m-d');
                $supplier_id = null;
            }

            $last_details = TransaksiPembelianDetail::with('transaksi_pembelian')->whereRelation('transaksi_pembelian', 'kode', $code)->where('soft_delete', 0)->get();

            return view('pembelian.pembelian_khusus.index', [
                "barang" => Barang::where('soft_delete', 0)->get(),
                "jenis_barang" => JenisBarang::where('soft_delete', 0)->get(),
                "satuan_barang" => SatuanBarang::where('soft_delete', 0)->get(),
                "code" => $code,
                "mode_edit" => $mode_edit,
                "supplier_id" => $supplier_id,
                "suppliers" => Supplier::where('soft_delete', 0)->get(),
                "kode_supplier" => $kode_supplier,
                "kode_jenis_barang" => $kode_jenis_barang,
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
            $data = DB::table('transaksi_masuk as a')
                ->leftJoin('suppliers as c', 'c.id', 'a.supplier_id')
                ->leftJoin('users as d', 'd.id', 'a.created_by')
                ->whereBetween('tanggal_transaksi', [$from_date_value, $to_date_value])
                ->where('a.soft_delete', 0)
                ->where('a.status', '!=', 0)
                ->select(
                    'a.*',
                    'c.nama as suppliers',
                    'd.name as user',
                    DB::raw("(select sum(qty) from transaksi_masuk_detail as b where b.transaksi_masuk_id = a.id and b.soft_delete = 0) as details_sum_qty"),
                    DB::raw("(select sum(qty*harga) from transaksi_masuk_detail as b where b.transaksi_masuk_id = a.id and b.soft_delete = 0) as details_sum_nominal"),
                )
                ->get();


            return DataTables::of($data)->addIndexColumn()
                ->addColumn('status', function ($item) {
                    if ($item->status == 1) {
                        $text = 'Complete';
                        $bg_color = 'bg-success';
                    } else if ($item->status == 2) {
                        $text = 'Disetujui';
                        $bg_color = 'bg-success';
                    } else if ($item->status == 3) {
                        $text = 'Tunda';
                        $bg_color = 'bg-danger';
                    }

                    return '<div class="badge ' . $bg_color . ' p-2 rounded">' . $text . '</div>';
                })
                ->addColumn('action', function ($item) use ($edit) {
                    $btn = '';
                    if (($item->status == 1 || $item->status == 3)) {
                        $btn .= '<button class="btn btn-danger btn-xs me-1" id="btn_delete" data-bs-toggle="modal" onclick="modal_hapus(' . $item->id . ', 1)" data-id="' . $item->id . '" data-bs-target="#modalDeleteConfirm"> <i class="fa fa-trash"></i></button>';
                    }
                    if (($item->status == 1 || $item->status == 3)) {
                        $btn .= '<a href="' . url('barang-masuk?edit=') . $item->id . '" class="btn btn-warning btn-xs me-1"> <i class="fa fa-pencil"></i></a>';
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
                "kode" => $request->kode,
                "tanggal_transaksi" => $request->tanggal_transaksi,
                "supplier_id" => $request->supplier_id,
                "status" => 1,
                "created_by" => auth()->user()->id
            ];
            TransaksiPembelian::where('kode', $request->kode)->update($data);
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function simpan_detail(Request $request)
    {
        $data = [
            "tanggal_transaksi" => $request->tanggal_transaksi,
            "supplier_id" => $request->supplier_id,
            "created_by" => auth()->user()->id
        ];

        $cek = TransaksiPembelian::where('kode', $request->kode)->first();

        if (!empty($cek)) {
            TransaksiPembelian::where('kode', $request->kode)->update($data);
            $transaksi_pembelian_id = $cek->id;
        } else {
            $data['kode'] = $request->kode;
            $data['status'] = 0;
            $val = TransaksiPembelian::create($data);
            $transaksi_pembelian_id = $val->id;
        }

        $data_detail = [
            "transaksi_masuk_id" => $transaksi_pembelian_id,
            "barang_id" => $request->barang_id,
            "harga" => replace_nominal($request->harga),
            "qty" => $request->qty,
        ];

        $insert = TransaksiPembelianDetail::create($data_detail);

        $data_stok = [
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'transaksi_id' => $transaksi_pembelian_id,
            'transaksi_detail_id' => $insert->id,
            'barang_id' => $request->barang_id,
            'stok_awal' => 0,
            'masuk' => $request->qty,
            'harga_masuk' => replace_nominal($request->harga),
            'keluar' => 0,
            'harga_keluar' => replace_nominal($request->harga),
            'stok_akhir' => $request->qty,
            'jenis' => 1,
            'created_by' => auth()->user()->id
        ];

        Stok::create($data_stok);

        $get_barang = Barang::where('id', $request->barang_id)->first();
        Barang::where('id', $request->barang_id)->update(['stok' => $get_barang->stok + $request->qty, 'updated_by' => auth()->user()->id]);

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
        $detail = TransaksiPembelian::where('kode', $request->kode)->first();
        $last_details = TransaksiPembelianDetail::where('transaksi_masuk_id', $detail->id)->where('soft_delete', 0)->get();

        return response()->json(['data' => $last_details]);
    }

    public function data_table_detail(Request $request)
    {
        $data = TransaksiPembelianDetail::with(['transaksi_pembelian'])->where('transaksi_masuk_id', $request->id)->where('soft_delete', 0)->get();

        return view('pembelian.pembelian_khusus.detail', compact('data'));
    }

    public function edit(Request $request)
    {
        $detail = TransaksiPembelianDetail::with('transaksi_pembelian')->where('id', $request->id)->first();
        $data = [
            'data' => $detail,
            'barang' => Barang::where('soft_delete', 0)->get(),
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
                TransaksiPembelian::where('id', $detail->transaksi_masuk_id)->update(['soft_delete' => 1]);
                TransaksiPembelianDetail::where('transaksi_masuk_id', $detail->transaksi_masuk_id)->update(['soft_delete' => 1]);
                Stok::where('jenis', 1)->where('transaksi_id', $detail->transaksi_masuk_id)->update(['soft_delete' => 1]);
            } else {
                TransaksiPembelianDetail::where('id', $request->id)->update(['soft_delete' => 1]);
                Stok::where('jenis', 1)->where('transaksi_detail_id', $request->id)->update(['soft_delete' => 1]);
            }
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }
}
