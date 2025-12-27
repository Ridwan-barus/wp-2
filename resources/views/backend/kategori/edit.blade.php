@extends('backend.layout')

@section('content')
<div class="card p-4 shadow-sm">
    <h4 class="fw-bold mb-4">Edit Kategori</h4>

    <form method="POST"
          action="{{ route('admin.kategori.update', $kategori->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text"
                   name="nama"
                   class="form-control"
                   value="{{ old('nama', $kategori->nama) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Kategori</label>
            <input type="file"
                   name="gambar"
                   class="form-control"
                   accept="image/*">
        </div>

        @if($kategori->gambar)
        <div class="mb-3">
            <label class="form-label d-block">Foto Saat Ini</label>
            <img src="{{ asset('uploads/kategori/' . $kategori->gambar) }}"
                 width="120"
                 class="rounded border">
        </div>
        @endif

        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('admin.kategori.index') }}"
               class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection