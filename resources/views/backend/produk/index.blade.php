@extends('backend.layout')

@section('title', 'Data Produk')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Produk</h3>

        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Size</th>
                        <th></th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach($produks as $index => $p)
                        <tr>
                            <!-- <td>{{ $index + 1 }}</td> -->
                            <td class="text-center">
                                <img src="{{ asset('uploads/' . $p->gambar) }}" 
                                    width="70" class="rounded border">
                            </td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->deskripsi }}</td>
                            <td>Rp{{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="grid-2">
                                    @forelse ($p->kategoris as $k)
                                        <span class="badge bg-info me-1">
                                            {{ $k->nama }}
                                        </span>
                                    @empty
                                        <span class="badge bg-secondary">-</span>
                                    @endforelse
                                </div>
                            </td>
                            <!-- <td>{{ $p->variations->sum('stok') }}</td> -->
                            <td>
                                <div class="grid-2">
                                    @foreach($p->variations as $v)
                                        <span class="badge bg-secondary">
                                            {{ $v->size }} ({{ $v->stok }})
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column gap-2">
                                    <!-- {{-- Tombol Edit --}} -->
                                    <a href="{{ route('admin.produk.edit', $p->id) }}" 
                                        class="btn btn-sm btn-warning me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
            
                                    <!-- {{-- Tombol Hapus --}} -->
                                    <button type="button"
                                            class="btn btn-sm btn-danger btn-hapus me-1"
                                            data-id="{{ $p->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
            
                                    <!-- {{-- FORM Hapus (HIDE) --}} -->
                                    <form id="form-hapus-{{ $p->id }}"
                                        action="{{ route('admin.produk.remove', $p->id) }}" 
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </div>
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
                title: "Hapus Produk?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan.",
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
