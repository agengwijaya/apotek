<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangStok extends Model
{
    use HasFactory;
    protected $table = 'gudang_stok';
    protected $guarded = ['id'];
    protected $with = ['barang', 'gudang', 'detail_stok'];

    public function detail_stok()
    {
        return $this->hasMany(GudangStokDetail::class)->orderBy('created_at', 'desc')->limit(9);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}
