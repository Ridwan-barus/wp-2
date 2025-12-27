<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Order;
use App\Models\ProdukVariation;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout($id){
        $produk = Produk::findOrFail($id);

        $sizes = $produk->variations()->get();

        return view('frontend.checkout', [
            'produk' => $produk,
            'sizes' => $sizes,
        ]);
    }

    public function process(Request $request){
        //dd($request->all());
        // process from checkout disini
        $request->validate([
            'produk_id' => 'required',
            'alamat' => 'required',
            'qty' => 'required',
            'size' => 'required',
            'harga_produk' => 'required',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu untuk melakukan pembayaran');
        }

        $produk = Produk::findOrFail($request->produk_id);

        $variation = ProdukVariation::where('produk_id', $produk->id)
                ->where('size', $request->size)
                ->first();

        if (!$variation) {
            return back()->with('error', 'Ukuran tidak tersedia');
        }

        // cek stok size
        if($request->qty > $variation->stok) {
            return back()->with('error', 'Stok tidak cukup untuk jumlah tersebut');
        }

        // simpan ke database
        Order::create([
            'produk_id' => $produk->id,
            'nama' => Auth::user()->nama,
            'hp' => Auth::user()->hp,
            'alamat' => $request->alamat,
            'harga_produk' => $request->harga_produk,
            'qty' => $request->qty,
            'size' => $request->size,
            'total_harga' => $request->harga_produk * $request->qty,
        ]);

        $variation->stok -= $request->qty;
        $variation->save();

        return redirect()->route('beranda')->with('success', 'Pesanan berhasil dibuat!');
    }
}
