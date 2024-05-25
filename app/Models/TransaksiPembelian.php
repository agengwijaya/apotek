<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeUnit\FunctionUnit;

class TransaksiPembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $guarded = ['id'];

    protected $with = ['supplier', 'details'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function details()
    {
        return $this->hasMany(TransaksiPembelianDetail::class, 'Nota');
    }
}
