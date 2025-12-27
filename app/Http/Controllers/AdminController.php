<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProdukVariation;
use App\Models\Kategori;


use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin(){
        if (Auth::user()->role != 1){
            return redirect()->route('beranda');
        }

        return view('backend.index');
    }

    public function orders(){
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return view('backend.orders', compact('orders'));
    }

    public function produk(){
        if (Auth::user()->role != 1){
            return redirect()->route('beranda');
        }

        $produks = Produk::with(['variations', 'kategoris'])
                ->orderBy('created_at', 'DESC')
                ->get();

        return view('backend.produk.index', compact('produks'));
    }

    public function create(){
        $kategoris = Kategori::all();

        return view('backend.produk.create', compact('kategoris'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|max:255',
            'harga' => 'required|numeric',
            'kategori_id' =>'required|array',
            'new_size' => 'required|string',
            'new_stok' => 'required|integer|min:0',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('uploads'), $fileName);

        $produk = Produk::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $fileName,
        ]);
        
        $produk->kategoris()->attach($request->kategori_id);
        
        ProdukVariation::create([
            'produk_id' => $produk->id,
            'size' => $request->new_size,
            'stok' => $request->new_stok,
        ]);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function remove($id){
        $produk = \App\Models\Produk::findOrFail($id);

        //hapus gambar fisik
        $path = public_path('uploads/' . $produk->gambar);
        if(file_exists($path)){
            unlink($path);
        }

        $produk->variations()->delete();
        $produk->delete();
        return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus');
    }

    public function edit($id) {
        $produk = Produk::with(['kategoris', 'variations'])-> findOrFail($id);
        $kategoris = Kategori::all();

        return view('backend.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id){
        //dd($request->all());

        $request->validate([
            'nama' =>'required',
            'harga' => 'required|numeric',
            'stok.*' => 'nullable|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|array',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        //update data
        $produk->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        //jika upload gambar baru
        if ($request->hasFile('gambar')) {
            //hapus gambar lama
            if($produk->gambar && file_exists(public_path('uploads/' . $produk->gambar))) {
                unlink(public_path('uploads/' . $produk->gambar));
            }

            $fileName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $fileName);

            $produk->update(['gambar' => $fileName]);
        }

        if ($request->has('stok')) {
            foreach ($request->stok as $variationId => $stok) {
                ProdukVariation::where('id', $variationId)
                    ->where('produk_id', $produk->id)
                    ->update(['stok' => $stok]);
            }
        }

        if ($request->new_size && $request->new_stok !== null) {
            ProdukVariation::create([
                'produk_id' => $produk->id,
                'size' => $request->new_size,
                'stok' => $request->new_stok,
            ]);
        }

        $produk->kategoris()->sync($request->kategori_id);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil di update');
    }

    public function pelanggan() {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('backend.pelanggan.index', compact('users'));
    }
}
