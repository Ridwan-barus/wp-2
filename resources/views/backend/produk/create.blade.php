@extends('backend.layout')

@section('title', 'Tambah Produk')

@section('content')

<div class="card shadow-sm p-4 border-0">
    <h3 class="fw-bold mb-4">Tambah Produk Baru</h3>

    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <h5 class="mt-4 fw-bold">Nama Produk</h5>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <h5 class="mt-4 fw-bold form-label">Kategori</h5>

            <div class="grid-3">
                @foreach($kategoris as $k)
                    <div class="form-check">
                        <input class="form-check-input"
                            type="checkbox"
                            name="kategori_id[]"
                            value="{{ $k->id }}"
                            id="kat{{ $k->id }}">

                        <label class="form-check-label" for="kat{{ $k->id }}">
                            {{ $k->nama }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <h5 class="mt-4 fw-bold">Harga Produk</h5>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <h5 class="mt-4 fw-bold">Stok per Size</h5>

            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="new_size" class="form-control" placeholder="Size (XL)">
                </div>
                <div class="col-md-4">
                    <input type="number" name="new_stok" class="form-control" placeholder="Stok" min="0" step="1">
                </div>
            </div>
        </div>

        <!-- DESKRIPSI -->
        <div class="mb-3">
            <h5 class="mt-4 fw-bold">Deskripsi Produk</h5>
            <textarea name="deskripsi"
                    class="form-control"
                    rows="4"
                    placeholder="Masukkan deskripsi produk..."></textarea>
        </div>

        <div class="mb-3">
            <h5 class="mt-4 fw-bold">Gambar Produk</h5>
            <input type="file" name="gambar" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan Produk</button>
        <a href="{{ route('admin.produk') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection
