<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_keluar';

    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(TransaksiPenjualanDetail::class, 'transaksi_keluar_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function oleh()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
