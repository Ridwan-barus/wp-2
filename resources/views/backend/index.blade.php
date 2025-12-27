@extends('backend.layout')

@section('title', 'Dashboard Admin')

@section('content')

<div class="card shadow-sm p-4 border-0">
    <h2 class="fw-bold mb-3">Selamat Datang, Admin!</h2>

    <p class="text-muted" style="font-size: 16px;">
        Halo <strong>{{ Auth::user()->name }}</strong>, selamat datang di halaman Dashboard Admin.
        Di halaman ini Anda dapat mengelola pesanan, produk, dan berbagai pengaturan toko batik Anda.
    </p>

    <p style="font-size: 16px;">
        Silakan pilih menu di bagian sidebar kiri untuk mulai mengelola sistem.
    </p>

    <div class="mt-4">
        <a href="{{ route('admin.orders') }}" class="btn btn-primary">
            Lihat Pesanan
        </a>
    </div>
</div>

@endsection
