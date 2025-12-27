<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukVariation extends Model
{
    protected $table = 'produk_variations';
    
    protected $fillable = ['produk_id', 'size', 'stok'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
