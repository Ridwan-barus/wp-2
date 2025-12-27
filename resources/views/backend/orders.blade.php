@extends('backend.layout')

@section('content')

<h3 class="fw-bold mb-4">List Pesanan Customer</h3>

@if($orders->count() == 0)
    <div class="alert alert-info">
        Belum ada pesanan.
    </div>
@else

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Customer</th>
            <th>Produk</th>
            <th>Alamat</th>
            <th>Qty</th>
            <th>Total Harga</th>
            <th>Tanggal Pesan</th>
        </tr>
    </thead>

    <tbody>
        @foreach($orders as $o)
        <tr>
            <td>{{ $o->id }}</td>
            <td>{{ $o->nama }}</td>
            <td>{{ $o->produk->nama ?? 'Produk tidak ditemukan' }}</td>
            <td>{{ $o->alamat }}</td>
            <td>{{ $o->qty }}</td>
            <td>Rp{{ number_format($o->total_harga, 0, ',', '.') }}</td>
            <td>{{ $o->created_at->format('d M Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif

@endsection
