@extends('backend.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Kategori</h3>
    
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </a>
    </div>
    
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $k)
                        <tr>
                            <td width="80">
                                @if($k->gambar)
                                    <img src="{{ asset('uploads/kategori/'.$k->gambar) }}" width="50" class="rounded">
                                @endif
                            </td>
                            <td class="align-middle">
                                <span class="fw-bold">{{ $k->nama }}</span>
                            </td>
                            <td width="150" class="text-center align-middle">
        
                                <!-- {{-- Tombol Edit --}} -->
                                <a href="{{ route('admin.kategori.edit', $k->id) }}" 
                                    class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
        
                                <!-- TOMBOL HAPPUS -->
                                <button type="button"
                                        class="btn btn-sm btn-danger btn-hapus me-1"
                                        data-id="{{ $k->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
        
                                <!-- FORM HAPUS (HIDE) -->
                                <form id="form-hapus-{{ $k->id }}"
                                    method="POST" class="d-inline" 
                                    action="{{ route('admin.kategori.destroy',$k->id) }}">
                                    @csrf @method('DELETE')
                                </form>
        
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll(".btn-hapus").forEach(btn => {
        btn.addEventListener("click", function () {
            let id = this.getAttribute("data-id");

            Swal.fire({
                title: "Hapus Kategori?",
                text: "Kategori yang sudah dihapus tidak bisa dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-hapus-${id}`).submit();
                }
            });
        });
    });
});
</script>

@endsection
