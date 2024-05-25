<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
	public function index()
	{
		try {
			$last_code = Customer::orderBy('id', 'desc')->limit(1)->get();

			if ($last_code->count()) {
				$replace = str_replace('CS00', '', $last_code[0]->KdPelanggan);
				$increment = $replace + 1;
				$code = 'CS00' . $increment;
			} else {
				$code = 'CS001';
			}

			return view('master.customers.index', [
				'customers' => Customer::get(),
				'code' => $code
			]);
		} catch (\Throwable $th) {
			dd($th);
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function store(Request $request)
	{
		try {
			$data_insert = [
				'KdPelanggan' => $request->KdPelanggan,
				'NmPelanggan' => $request->NmPelanggan,
				'Alamat' => $request->Alamat,
				'Kota' => $request->Kota,
				'Telpon' => $request->Telpon,
			];

			Customer::create($data_insert);

			return back();
		} catch (\Throwable $th) {
			dd($th);
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function update(Request $request, $id)
	{
		try {
			$data_update = [
				'NmPelanggan' => $request->NmPelanggan,
				'Alamat' => $request->Alamat,
				'Kota' => $request->Kota,
				'Telpon' => $request->Telpon,
			];

			Customer::where('id', $id)->update($data_update);

			return back();
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function destroy($id)
	{
		try {
			Customer::where('id', $id)->delete();

			return back();
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}
}
