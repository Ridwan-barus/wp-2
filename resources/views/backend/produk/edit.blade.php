@extends('backend.layout')

@section('title', 'Edit Produk')

@section('content')

<div class="card shadow-sm p-4 border-0">
    <h3 class="fw-bold mb-4">Edit Produk</h3>

    <form action="{{ route('admin.produk.update', $produk->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <h5 class="mt-4 fw-bold form-label">Nama Produk</h5>
            <input type="text" name="nama" class="form-control" 
                   value="{{ $produk->nama }}" required>
        </div>

        <div class="mb-3">
            <h5 class="mt-4 fw-bold form-label">Kategori</h5>
            <div class="d-flex flex-wrap gap-2">
                @foreach($kategoris as $k)
                    <div class="form-check">
                        <input class="form-check-input"
                            type="checkbox"
                            name="kategori_id[]"
                            value="{{ $k->id }}"
                            id="kat{{ $k->id }}"
                            {{ $produk->kategoris->contains($k->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="kat{{ $k->id }}">
                            {{ $k->nama }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <h5 class="mt-4 fw-bold form-label">Harga</h5>
            <input type="number" name="harga" class="form-control" 
                   value="{{ $produk->harga }}" required>
        </div>

        <div class="mb-3">
            <h5 class="mt-4 fw-bold">Stok per Size</h5>

            @foreach($produk->variations as $v)
                <div class="row mb-2">
                    <div class="col-md-4">
                        <input type="text"
                            class="form-control"
                            value="{{ $v->size }}"
                            disabled>
                    </div>

                    <div class="col-md-4">
                        <input type="number"
                            name="stok[{{ $v->id }}]"
                            class="form-control"
                            value="{{ $v->stok }}"
                            min="0">
                    </div>
                </div>
            @endforeach
            <hr>
            <h5 class="mt-4 fw-bold">Tambah Size Baru</h5>

            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="new_size" class="form-control" placeholder="Size (XL)">
                </div>
                <div class="col-md-4">
                    <input type="number" name="new_stok" class="form-control" placeholder="Stok" min="0" step="1">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <h5 class="mt-4 fw-bold form-label">Deskripsi Produk</h5>
            <textarea name="deskripsi"
                    class="form-control"
                    rows="4"
                    placeholder="Masukkan deskripsi produk...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <h5 class="mt-4 fw-bold form-label">Gambar Produk</h5>
            <input type="file" name="gambar" class="form-control">

            <p class="mt-2">Gambar saat ini:</p>
            <img src="{{ asset('uploads/' . $produk->gambar) }}" 
                 width="120" class="border rounded">
        </div>

        <button class="btn btn-primary">Update Produk</button>
        <a href="{{ route('admin.produk') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>

@endsection
