<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanStokController extends Controller
{
	public function index()
	{
		try {
			return view('laporan.index', []);
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function list(Request $request)
	{
		if ($request->ajax()) {
			$query = Barang::with(['stoks'])->where('soft_delete', 0)->latest();
			$from_date_value = $request->from ?? date('Y-m-01');
			$to_date_value = $request->to ?? date('Y-m-d');

			if (!empty($from_date_value) && !empty($to_date_value)) {
				$start_date = date('Y-m-d', strtotime($from_date_value));
				$end_date = date('Y-m-d', strtotime($to_date_value));
				$data = $query->whereRelation('stoks', 'tanggal_transaksi', '>=', $start_date)->whereRelation('stoks', 'tanggal_transaksi', '<=', $end_date)->get();
			} else {
				$data = $query->get();
			}
			return DataTables::of($data)->addIndexColumn()
				->addColumn('action', function ($item) {
					$btn = '<button type="button" class="btn btn-info btn-xs details-control"> <i class="fa fa-search"></i></button>';
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
		}
	}
}
