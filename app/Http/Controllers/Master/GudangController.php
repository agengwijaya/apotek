<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
	public function index()
	{
		try {
			$last_code = Gudang::orderBy('id', 'desc')->limit(1)->get();
	
			if ($last_code->count()) {
				$replace = str_replace('GD', '', $last_code[0]->kode);
				$increment = $replace + 1;
				$code = 'GD00' . $increment;
			} else {
				$code = 'GD001';
			}
	
			return view('master.gudang.index', [
				'customers' => Gudang::where('soft_delete', '!=', 1)->get(),
				'code' => $code
			]);
		} catch (\Throwable $th) {
				return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function store(Request $request)
	{
		try {
			$data_insert = [
				'kode' => $request->kode,
				'nama' => $request->nama,
				'keterangan' => $request->keterangan ?? '-',
				'alamat' => $request->alamat,
			];
	
			Gudang::create($data_insert);
	
			return redirect('data-master/data-gudang');
		} catch (\Throwable $th) {
				return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function update(Request $request, $id)
	{
		try {
			$data_update = [
				'nama' => $request->nama,
				'alamat' => $request->alamat,
				'keterangan' => $request->keterangan ?? '-',
			];
	
			Gudang::where('id', $id)->update($data_update);
	
			return back();
		} catch (\Throwable $th) {
				return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function destroy($id)
	{
		try {
			Gudang::where('id', $id)->update([
				'soft_delete' => 1
			]);
			return back();
		} catch (\Throwable $th) {
				return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}
}
