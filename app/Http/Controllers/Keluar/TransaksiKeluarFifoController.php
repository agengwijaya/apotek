<?php

namespace App\Http\Controllers\Keluar;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\JenisBarang;
use App\Models\SatuanBarang;
use App\Models\Stok;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPenjualan;
use App\Models\TransaksiPenjualanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransaksiKeluarFifoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $jumlah_customer = Customer::count();
            $kode_customer = "SP" . sprintf("%03d", $jumlah_customer + 1);
            $jumlah_jenis_barang = JenisBarang::count();
            $kode_jenis_barang = "JB" . sprintf("%03d", $jumlah_jenis_barang + 1);
            $jumlah_barang = Barang::count();
            $kode_barang = "BR" . sprintf("%03d", $jumlah_barang + 1);

            $last_code = TransaksiPenjualan::where(DB::RAW("substring(created_at,1,10)"), date('Y-m-d'))->count();
            if (!empty($request->edit)) {
                $last_insert = TransaksiPenjualan::where('id', $request->edit)->first();
                $mode_edit = true;
            } else {
                $last_insert = TransaksiPenjualan::where('status', 0)->where('created_by', auth()->user()->id)->first();
                $mode_edit = false;
            }
            if (!empty($last_insert)) {
                $code = $last_insert->kode;
                $tanggal_transaksi = $last_insert->tanggal_transaksi;
                $customer_id = $last_insert->customer_id;
            } else {
                $code = "PJK" . date('dmy') . sprintf("%03d", $last_code + 1);
                $tanggal_transaksi = date('Y-m-d');
                $customer_id = null;
            }
            $last_details = TransaksiPenjualanDetail::with('transaksi_penjualan')->whereRelation('transaksi_penjualan', 'kode', $code)->where('soft_delete', 0)->get();

            return view('penjualan.penjualan_khusus.index', [
                "barang" => Barang::where('soft_delete', 0)->get(),
                "jenis_barang" => JenisBarang::where('soft_delete', 0)->get(),
                "satuan_barang" => SatuanBarang::where('soft_delete', 0)->get(),
                "code" => $code,
                "mode_edit" => $mode_edit,
                "customer_id" => $customer_id,
                "customer" => Customer::where('soft_delete', 0)->get(),
                "kode_customer" => $kode_customer,
                "kode_jenis_barang" => $kode_jenis_barang,
                "kode_barang" => $kode_barang,
                "tanggal_transaksi" => $tanggal_transaksi,
                "detail_penjualan_khusus" => $last_details
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
            $data = DB::table('transaksi_keluar as a')
                ->leftJoin('customers as c', 'c.id', 'a.customer_id')
                ->leftJoin('users as d', 'd.id', 'a.created_by')
                ->whereBetween('tanggal_transaksi', [$from_date_value, $to_date_value])
                ->where('a.jenis', 1)
                ->where('a.soft_delete', 0)
                ->where('a.status', '!=', 0)
                ->select(
                    'a.*',
                    'c.nama as customer',
                    'd.name as user',
                    DB::raw("(select sum(qty) from transaksi_keluar_detail as b where b.transaksi_keluar_id = a.id and b.soft_delete = 0) as details_sum_qty"),
                    DB::raw("(select  sum(qty*harga) from transaksi_keluar_detail as b where b.transaksi_keluar_id = a.id and b.soft_delete = 0) as details_sum_nominal"),
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
                        $btn .= '<a href="#" class="btn btn-warning btn-xs me-1"> <i class="fa fa-pencil"></i></a>';
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
                "customer_id" => $request->customer_id,
                "jenis" => 1,
                "status" => 1,
                "created_by" => auth()->user()->id
            ];
            TransaksiPenjualan::where('kode', $request->kode)->update($data);
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function simpan_detail(Request $request)
    {
        $data = [
            "tanggal_transaksi" => $request->tanggal_transaksi,
            "customer_id" => $request->customer_id,
            "jenis" => 1,
            "created_by" => auth()->user()->id
        ];

        $cek = TransaksiPenjualan::where('kode', $request->kode)->first();
        if (!empty($cek)) {
            TransaksiPenjualan::where('kode', $request->kode)->update($data);
            $transaksi_penjualan_id = $cek->id;
        } else {
            $data['kode'] = $request->kode;
            $data['status'] = 0;
            $val = TransaksiPenjualan::create($data);
            $transaksi_penjualan_id = $val->id;
        }

        $data_detail = [
            "transaksi_keluar_id" => $transaksi_penjualan_id,
            "barang_id" => $request->barang_id,
            "qty" => $request->qty,
        ];

        $insert = TransaksiPenjualanDetail::create($data_detail);

        $sisa = $request->qty;
        $text = '';
        while ($sisa > 0) {
            $value_stok = Stok::where('jenis', 1)->where('barang_id', $request->barang_id)->where('stok_akhir', '!=', 0)->where('soft_delete', 0)->orderBy('tanggal_transaksi', 'asc')->orderBy('id', 'asc')->first();
            $text .= $value_stok->stok_akhir . ',';
            $data_stok = [
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'transaksi_id' => $transaksi_penjualan_id,
                'transaksi_detail_id' => $insert->id,
                'barang_id' => $request->barang_id,
                'stok_awal' => doubleval($value_stok->stok_akhir),
                'masuk' => 0,
                'harga_masuk' => $value_stok->harga_keluar,
                'harga_keluar' => doubleval($value_stok->harga_keluar * $request->qty),
                'jenis' => 2,
                'created_by' => auth()->user()->id
            ];

            if ($sisa > $value_stok->stok_akhir) {
                $data_stok['stok_akhir'] = 0;
                $data_stok['keluar'] = $value_stok->stok_akhir;
                Stok::create($data_stok);
                Stok::where('id', $value_stok->id)->update(['stok_akhir' => doubleval($value_stok->stok_masuk), 'keluar' => $value_stok->stok_akhir]);
            } else {
                $data_stok['stok_akhir'] = doubleval($value_stok->stok_akhir - $sisa);
                $data_stok['keluar'] = $sisa;
                Stok::create($data_stok);
                Stok::where('id', $value_stok->id)->update(['stok_akhir' => doubleval($value_stok->stok_akhir - $sisa), 'keluar' => $sisa]);
            }

            $sisa -= $value_stok->stok_akhir;
        }

        $get_barang = Barang::where('id', $request->barang_id)->first();
        Barang::where('id', $request->barang_id)->update(['stok' => doubleval($get_barang->stok - $request->qty), 'updated_by' => auth()->user()->id]);

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
        $detail = TransaksiPenjualan::where('kode', $request->kode)->first();
        $last_details = TransaksiPenjualanDetail::where('transaksi_keluar_id', $detail->id)->where('soft_delete', 0)->get();

        return response()->json(['data' => $last_details]);
    }

    public function data_table_detail(Request $request)
    {
        $data = TransaksiPenjualanDetail::with(['transaksi_penjualan'])->where('transaksi_keluar_id', $request->id)->where('soft_delete', 0)->get();

        return view('penjualan.penjualan_khusus.detail', compact('data'));
    }

    public function edit(Request $request)
    {
        $detail = TransaksiPenjualanDetail::where('id', $request->id)->first();
        $data = [
            'data' => $detail,
            'barang' => Barang::where('soft_delete', 0)->get(),
        ];
        return view('penjualan.penjualan_khusus.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $data_detail = [
                "barang_id" => $request->barang_id,
                "qty" => $request->qty,
            ];
            TransaksiPenjualanDetail::where('id', $id)->update($data_detail);
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function hapus(Request $request)
    {
        try {
            if (!empty($request->jenis)) {
                TransaksiPenjualan::where('id', $request->id)->update(['soft_delete' => 1]);
                TransaksiPenjualanDetail::where('transaksi_keluar_id', $request->id)->update(['soft_delete' => 1]);
            } else {
                TransaksiPenjualanDetail::where('id', $request->id)->update(['soft_delete' => 1]);
            }
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

	public function get_barang()
	{
		$data = Barang::where('soft_delete', 0)->get();

		if ($data) {
			$res = [
				'status' => true,
				'data' => $data
			];
		} else {
			$res = [
				'status' => false,
			];
		}

		return response()->json($res);
	}
}
