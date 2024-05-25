<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\SatuanBarang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ObatController extends Controller
{
  public function index()
  {
    try {
      $last_code_barang = Barang::count();
      $code_barang = "BR" . sprintf("%03d", $last_code_barang + 1);

      return view('master.barang.index', [
        'supplier' => Supplier::all(),
        'code_barang' => $code_barang,
        'barang' => Barang::get(),
        'title' => 'Data Barang'
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
        'KdObat' => $request->KdObat,
        'KdSuplier' => $request->KdSuplier,
        'NmObat' => $request->NmObat,
        'Jenis' => $request->Jenis,
        'Satuan' => $request->Satuan,
        'HargaBeli' => $request->HargaBeli,
        'HargaJual' => $request->HargaJual,
        'Stok' => $request->Stok,
        'KdSupplier' => $request->KdSupplier,
      ];

      Barang::create($data_insert);

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
        'KdSuplier' => $request->KdSuplier,
        'NmObat' => $request->NmObat,
        'Jenis' => $request->Jenis,
        'Satuan' => $request->Satuan,
        'HargaBeli' => $request->HargaBeli,
        'HargaJual' => $request->HargaJual,
        'Stok' => $request->Stok,
        'KdSupplier' => $request->KdSupplier,
      ];

      Barang::where('id', $id)->update($data_update);

      return back();
    } catch (\Throwable $th) {
      return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
    }
  }

  public function destroy($id)
  {
    try {
      Barang::where('id', $id)->delete();

      return back();
    } catch (\Throwable $th) {
      return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
    }
  }
}
