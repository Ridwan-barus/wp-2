<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{

    public function index() {
        $orders = Order::where('nama', Auth::user()->nama)
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('frontend.orders.index', compact('orders'));
    }

    public function show($id) {
        $order = Order::findOrFail($id);

        //validasi agar user hanya bisa liat pesanan dia sendiri
        if($order->nama != Auth::user()->nama) {
            abort(403, 'Unauthorized');
        }

        return view('frontend.orders.show', compact('order'));
    }

    public function pdf($id)
    {
        $order = Order::with('produk')->findOrFail($id);
    
        $pdf = Pdf::loadView('frontend.orders.pdf', compact('order'))
                  ->setPaper('A4', 'portrait');
    
        return $pdf->download('invoice-order-'.$order->id.'.pdf');
    }
}
