<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeUnit\FunctionUnit;

class TransaksiPembelian extends Model
{
    use HasFactory;

    protected $table = 'transaksi_masuk';

    protected $guarded = ['id'];

    protected $with = ['supplier', 'details', 'jenis_barang'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function details()
    {
        return $this->hasMany(TransaksiPembelianDetail::class, 'transaksi_masuk_id')->where('soft_delete', 0);
    }

    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }

    public function oleh()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
