@extends('frontend.layout')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Pesanan Saya</h3>

    @if ($orders->count() == 0)
        <div class="alert alert-info">
            Belum ada pesanan.
        </div>
    @endif

    <div class="row g-4">
        @foreach ($orders as $order)
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="fw-bold">{{ $order->produk->nama }}</h5>
                    <p class="text-muted mb-1">Jumlah: {{ $order->qty }}</p>
                    <p>Total: <strong>Rp{{ number_format($order->total_harga) }}</strong></p>

                    <a href="{{ route('orders.show', $order->id) }}" 
                       class="btn btn-dark mt-2 w-100">
                        Lihat Detail
                    </a>

                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
