<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'produk_id',
        'nama',
        'hp',
        'alamat',
        'harga_produk',
        'qty',
        'size',
        'total_harga',
    ];

    public function produk(){
        return $this->belongsTo(\App\Models\Produk::class, 'produk_id');
    }
}
