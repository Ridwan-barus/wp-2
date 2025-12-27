<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'nama', 
        'slug',
        'gambar',
    ];

    public function produks()
    {
        return $this->belongsToMany(
            Produk::class,
            'kategori_produk',
            'kategori_id',
            'produk_id'
        );
    }
}
