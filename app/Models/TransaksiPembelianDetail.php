<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelianDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_masuk_detail';

    protected $guarded = ['id'];

    protected $with = ['barang', 't_satuan_barang'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function t_satuan_barang()
    {
        return $this->belongsTo(SatuanBarang::class, 'satuan_barang_id', 'id');
    }

    public function transaksi_pembelian()
    {
        return $this->belongsTo(TransaksiPembelian::class, 'transaksi_masuk_id');
    }
}
