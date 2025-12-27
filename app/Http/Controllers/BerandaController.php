<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;

class BerandaController extends Controller
{
    public function berandaFrontend()
    {
        
        $produk = Produk::withAvg('ratings', 'rating')
                    ->withCount('ratings')
                    ->orderByDesc('ratings_avg_rating')
                    ->take(8)
                    ->get();

        $produkTerbaru = Produk::latest('updated_at')
                            ->take(8)
                            ->get();

        $kategoris = \App\Models\Kategori::all();


        $testimoni = \App\Models\Testimoni::with('user')->latest()->take(6)->get();
        
        return view('frontend.beranda', compact(
            'produk',
            'produkTerbaru',
            'kategoris',
            'testimoni',
        ));
    }

    public function loginPage()
    {
        return view('frontend.auth.login', [
            'judul' => 'Login'
        ]);
    }

    public function syaratketentuan() {
        return view('frontend.s&k.index', [
            'judul' => 'Syarat dan Ketentuan'
        ]);
    }
}
