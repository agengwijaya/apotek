<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        try {
            $jumlah = Wilayah::count();
            $kode = "WY" . sprintf("%03d", $jumlah + 1);
            return view('master.wilayah.index', [
                'kode' => $kode,
                'wilayah' => Wilayah::where('soft_delete', 0)->get()
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function simpan(Request $request)
    {
        try {
            $data_insert = [
                'kode' => $request->kode,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan ?? '-',
                'created_by' => auth()->user()->id
            ];
    
            Wilayah::create($data_insert);
    
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data_update = [
                'kode' => $request->kode,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan ?? '-',
                'updated_by' => auth()->user()->id
            ];
    
            Wilayah::where('id', $id)->update($data_update);
    
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function hapus($id)
    {
        try {
            Wilayah::where('id', $id)->update(['soft_delete' => 1, 'deleted_by' => auth()->user()->id]);
    
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }
}
