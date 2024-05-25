<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_keluar_detail';

    protected $guarded = ['id'];

    protected $with = ['barang'];

    public function transaksi_penjualan()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'transaksi_keluar_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
