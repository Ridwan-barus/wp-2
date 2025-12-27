@extends('backend.layout')

@section('title', 'Rating Produk')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-4">Rating & Review Produk</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Nama Produk</th>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ratings as $r)
                    <tr>
                        <!-- GAMBAR -->
                        <td style="width:80px">
                            <img src="{{ asset('uploads/' . $r->produk->gambar) }}"
                                 class="rounded"
                                 style="width:60px; height:60px; object-fit:cover;">
                        </td>

                        <!-- NAMA PRODUK -->
                        <td>
                            <strong>{{ $r->produk->nama }}</strong>
                        </td>

                        <!-- USER -->
                        <td>
                            {{ $r->user->nama ?? '-' }}
                        </td>

                        <!-- RATING -->
                        <td>
                            <div class="text-warning">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $r->rating)
                                        ★
                                    @else
                                        <span class="text-muted">★</span>
                                    @endif
                                @endfor
                            </div>
                        </td>

                        <!-- REVIEW -->
                        <td style="max-width:300px">
                            <span class="text-muted">
                                {{ $r->review ?? '-' }}
                            </span>
                        </td>

                        <!-- TANGGAL -->
                        <td>
                            {{ $r->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Belum ada rating
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $ratings->links() }}
        </div>
    </div>
</div>
@endsection