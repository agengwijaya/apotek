<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $guarded = ['id'];

    protected $with = ['supplier'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'KdSuplier', 'KdSuplier');
    }
}
