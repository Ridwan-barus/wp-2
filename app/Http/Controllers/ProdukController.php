<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Like;
use App\Models\Rating;

class ProdukController extends Controller
{
    public function index(Request $request) {
        $kategoris = Kategori::all();

        if($request->filled('kategoris') && $request->kategoris != 'semua') {
            $produk = Produk::whereHas('kategoris', function ($q) use ($request) {
                $q->where('kategori_id', $request->kategoris);
            })->get();
        } else {
            $produk = Produk::all();
        }

        return view('frontend.produk.index', compact('produk', 'kategoris'));
    }

    public function detail($id){
        $produk = Produk::findOrFail($id);

        //ambil semua variasi ukuran + stok
        $sizes = $produk->variations()->get();  //Produk::where('nama', $produk->nama)->get();

        $totalStok = $produk->variations()->sum('stok');

        return view('frontend.detail-produk', [
            'produk' => $produk,
            'size' => $sizes,
            'totalStok' => $totalStok,
        ]);
    }

    public function liked() {
        $likes = auth()->user()->likes()->with('produk')->get();

        return view('frontend.likes.index', compact('likes'));
    }

    public function like($id)
    {
        $produk = Produk::findOrFail($id);

        // toggle like
        $like = Like::where('user_id', auth()->id())
                    ->where('produk_id', $produk->id)
                    ->first();

        if ($like) {
            // kalau sudah like → unlike
            $like->delete();
            return response()->json([
                'liked' => false,
                'action' => 'removed',
            ]);
        } else {
            // kalau belum like → like
            Like::create([
                'user_id' => auth()->id(),
                'produk_id' => $produk->id,
            ]);
            
            return response()->json([
                'liked' => true,
                'action' => 'added'
            ]);
        }
    }

    public function rating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Rating::updateOrCreate(
            [
                'produk_id' => $id,
                'user_id' => auth()->id(),
            ],
            [
                'rating' => $request->rating,
                'review' => $request->review,
            ]
        );

        return back()->with('success', 'Rating berhasil disimpan');
    }
}
