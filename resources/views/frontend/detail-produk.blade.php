@extends('frontend.layout')

@section('content')

<div class="row g-5 container-fluid px-5">

    <!-- {{-- GAMBAR PRODUK --}} -->
    <div class="col-md-6">
        <div class="border rounded shadow-sm p-3">
            <img src="{{ asset('uploads/' . $produk->gambar) }}" 
                 class="img-fluid rounded" 
                 style="object-fit:cover; width:100%; height:auto;">
        </div>
    </div>

    <!-- {{-- DETAIL PRODUK --}} -->
    <div class="col-md-6">
        <h4 class="fw-bold">{{ $produk->nama }}</h4>

        <!-- {{-- KATEGORI --}} -->
        <p class="text-muted small mb-2 text-uppercase">
            {{ $produk->kategori }}
        </p>

        <!-- RATING -->
        <div class="product-rating d-flex align-items-center gap-2 mb-2">
            <div class="stars">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= floor($produk->average_rating))
                        <i class="bi bi-star-fill"></i>
                    @else
                        <i class="bi bi-star"></i>
                    @endif
                @endfor
            </div>

            <span class="rating-count">
                ({{ $produk->total_rating }})
            </span>
        </div>

        <!-- {{-- HARGA --}} -->
        <h3 class="fw-bold text-danger mb-4">
            Rp{{ number_format($produk->harga, 0, ',', '.') }}
        </h3>

        <!-- {{-- STOK --}} -->
        <p class="text-muted">Stok tersedia: {{ $totalStok }}</p>

        <!-- {{-- DESKRIPSI PRODUK --}} -->
        <p class="text-secondary mb-4">
            {{ $produk->deskripsi ?? 'Tidak ada deskripsi untuk produk ini.' }}
        </p>

        <!-- {{-- TOMBOL --}} -->
        <a href="{{ route('checkout.page', $produk->id) }}" class="btn btn-success btn-lg">
            <i class="bi bi-lightning-fill me-1"></i> Beli Sekarang
        </a>
        <!-- <div class="d-flex gap-2">

            <form action="{{ route('cart.add', $produk->id) }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-lg">
                    <i class="bi bi-heart me-1"></i> Tambah ke Keranjang
                </button>
            </form>
        </div> -->
    </div>
    
    <!-- {{-- SECTION PRODUK LAINNYA --}} -->
    <h4 class="fw-bold mb-3">Produk Lainnya</h4>
    
    <div class="row g-4">
        @foreach(\App\Models\Produk::where('id', '!=', $produk->id)->take(4)->get() as $p)
        @include('frontend.components.card-produk', ['item' => $p])
        @endforeach
    </div>

    <!-- {{-- SECTION FORM RATING --}} -->
    <h5 class="fw-bold mt-4">Beri Rating</h5>

    @auth
    <form action="{{ route('produk.rating', $produk->id) }}" method="POST">
        @csrf

        <!-- hidden input buat kirim nilai -->
        <input type="hidden" name="rating" id="ratingValue" required>

        <!-- STAR RATING -->
        <div class="star-rating mb-2">
            @for ($i = 1; $i <= 5; $i++)
                <i class="bi bi-star star"
                data-value="{{ $i }}"></i>
            @endfor
        </div>

        <!-- REVIEW INPUT -->
        <div class="review-input">
            <textarea name="review"
                class="form-control review-textarea"
                placeholder="Tulis ulasan (opsional)"
                rows="1"></textarea>

            <button class="btn send-btn" type="submit">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
    </form>
    @else
    <p class="text-muted">
        <a href="{{ route('login') }}">Login</a> untuk memberi rating
    </p>
    @endauth
</div>



<style>
    /* Produk rating */
    .product-rating {
        line-height: 1;
    }

    .product-rating .stars i {
        color: #ffc107; /* kuning bootstrap */
        font-size: 20px;
    }

    .product-rating .stars i.bi-star {
        color: #ddd;
    }

    .product-rating .rating-count {
        font-size: 14px;
        color: #6c757d;
        margin-top: 2px;
    }

    /* rating input */
    .star-rating {
        font-size: 26px;
        cursor: pointer;
    }

    .star {
        color: #ccc; /* abu */
        transition: color 0.2s;
    }

    .star.active {
        color: #ffc107; /* kuning */
    }

    /* INPUT AREA */
    .review-input {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .review-textarea {
        resize: none;
        height: 48px;
        border-radius: 12px;
        padding: 12px 14px;
    }

    /* SEND BUTTON */
    .send-btn {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #111;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .send-btn i {
        font-size: 18px;
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingValue');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-value');
            ratingInput.value = rating;

            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.add('active');
                    s.classList.replace('bi-star', 'bi-star-fill');
                } else {
                    s.classList.remove('active');
                    s.classList.replace('bi-star-fill', 'bi-star');
                }
            });
        });
    });
});
</script>



@endsection
