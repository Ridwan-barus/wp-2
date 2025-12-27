@extends('backend.layout')

@section('content')
<div class="card p-4 shadow-sm">
    <h4 class="fw-bold mb-4">Tambah Kategori</h4>

    <form method="POST" 
          action="{{ route('admin.kategori.store') }}" 
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" 
                   name="nama" 
                   class="form-control" 
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Kategori</label>
            <input type="file" 
                   name="gambar" 
                   class="form-control"
                   accept="image/*"
                   required>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('admin.kategori.index') }}" 
               class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection