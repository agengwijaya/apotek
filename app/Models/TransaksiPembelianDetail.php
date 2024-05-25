<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelianDetail extends Model
{
    use HasFactory;

    protected $table = 'pembelian_detail';

    protected $guarded = ['id'];

    protected $with = ['barang'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'KdObat', 'KdObat');
    }

    public function transaksi_pembelian()
    {
        return $this->belongsTo(TransaksiPembelian::class, 'Nota');
    }
}
