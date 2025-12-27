<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Produk extends Model
{
    protected $casts = [
        'is_new' => 'boolean',
    ];

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'harga',
        'rating',
    ];

    public function getIsNewAttribute() {
        if (!$this->updated_at) {
            return false;
        }
        return $this->updated_at->gt(now()->subHour());
    }

    public function likes() {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function isLikedByUser() {
        if(!auth()->check()) {
            return false;
        }

        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function variations()
    {
        return $this->hasMany(ProdukVariation::class);
    }

    public function kategoris()
    {
        return $this->belongsToMany(
            Kategori::class,
            'kategori_produk',   // nama tabel pivot (WAJIB)
            'produk_id',         // FK ke produk
            'kategori_id'        // FK ke kategori
        );
    }

    public function ratings() {
        return $this->hasMany(\App\Models\Rating::class);
    }

    public function getAverageRatingAttribute() {
        return round($this->ratings()->avg('rating'), 1) ?? 0;
    }

    public function getTotalRatingAttribute()
    {
        return $this->ratings()->count();
    }
}
