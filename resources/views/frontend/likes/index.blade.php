@extends('frontend.layout')

@section('content')

<h3 class="container py-4 fw-bold mb-4">Wishlist Kamu</h3>
<div class="container py-4" id="wishlist-page">


    @if ($likes->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-heart" style="font-size: 60px;"></i>
            <p class="mt-3 text-muted">Belum ada produk yang kamu sukai.</p>
        </div>
    @else
        <div class="row">
            @foreach ($likes as $like)
                @php $produk = $like->produk; @endphp

                <div class="col-md-3 mb-4 wishlist-item" id="wishlist-{{ $produk->id }}">
                    <a href="{{ route('produk.detail', $produk->id) }}" class="text-decoration-none text-dark">

                        <div class="card border-0 shadow-sm h-100">

                            <div class="position-absolute" style="z-index:10; top:10px; right:10px;">
                                <button type="button"
                                    class="btn btn-light rounded-circle shadow-sm wishlist-btn d-flex align-items-center justify-content-center"
                                    data-id="{{ $produk->id }}"
                                    style="width: 35px; height: 35px;">
                                    <i class="bi bi-heart-fill text-danger"></i>
                                </button>
                            </div>

                            <img src="{{ asset('uploads/' . $produk->gambar) }}"
                                class="card-img-top"
                                style="width: 100%; height: 260px; object-fit: contain;">

                            <div class="card-body">
                                <p class="text-uppercase small text-muted mb-1" style="font-size: 11px;">
                                    {{ $produk->kategori ?? '-' }}
                                </p>

                                <h6 class="fw-bold">{{ $produk->nama }}</h6>

                                <h5 class="fw-bold text-dark">
                                    Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                </h5>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</div>

@endsection
