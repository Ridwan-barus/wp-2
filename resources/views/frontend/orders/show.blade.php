@extends('frontend.layout')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Detail Pesanan</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="fw-bold">{{ $order->produk->nama }}</h4>

            <p class="mb-1">Nama Pembeli: {{ $order->nama }}</p>
            <p class="mb-1">HP: {{ $order->hp }}</p>
            <p class="mb-1">Alamat: {{ $order->alamat }}</p>
            <hr>

            <p class="mb-1">Harga Produk: Rp{{ number_format($order->harga_produk) }}</p>
            <p class="mb-1">Quantity: {{ $order->qty }}</p>
            <p class="fw-bold">Total Harga: Rp{{ number_format($order->total_harga) }}</p>
        </div>

        <a href="{{ route('orders.pdf', $order->id) }}" class="btn btn-danger mt-3">
            <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
        </a>
        
    </div>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">
        Kembali
    </a>

</div>
@endsection
