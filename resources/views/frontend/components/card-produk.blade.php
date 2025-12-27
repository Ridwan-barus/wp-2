<div class="col-md-3 mb-4">
    <div class="card border-0 shadow-sm h-100 position-relative">

        <!-- {{-- BADGE NEW --}} -->
        @if ($item->is_new)
        <div class="position-absolute" style="z-index:10; top:10px; left:10px;">
            <span class="badge bg-danger">NEW</span>
        </div>
        @endif

        <!-- {{-- WISHLIST ICON --}} -->
        <div class="position-absolute" style="z-index:10; top:10px; right:10px;">
            <button type="button"
                    class="btn btn-light rounded-circle shadow-sm wishlist-btn"
                    data-id="{{ $item->id }}"
                    style="width: 35px; height: 35px; padding: 0;">
                <i class="bi {{ $item->isLikedByUser() ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
            </button>
            <!-- <form action="{{ route('product.like', $item->id) }}" method="POST">
                @csrf
            </form> -->
        </div>

        <!-- {{-- IMAGE --}} -->
         <a href="{{ route('produk.detail', $item->id) }}">
             <img src="{{ asset('uploads/' . $item->gambar) }}"
                 class="product-image w-100"
                 style="width: 100%; height:260px; object-fit:contain;">
             
             <!-- {{-- overlay hover --}} -->
             <div class="hover-overlay"></div>
         </a>
        <!-- <div class="position-relative">
        </div> -->

        <!-- {{-- CARD BODY --}} -->
        <div class="card-body">

            <!-- {{-- KATEGORI --}} -->
            <p class="text-uppercase small text-muted mb-1"
                style="font-size: 11px; letter-spacing: 0.5px;">
                {{ $item->kategori ?? '-' }}
            </p>

            <!-- {{-- NAMA --}} -->
            <a href="{{ route('produk.detail', $item->id) }}"
                class="text-decoration-none text-dark">
                <h6 class="fw-bold mb-2">{{ $item->nama }}</h6>
            </a>

            <!-- {{-- RATING --}} -->
             <div class="d-flex align-items-center gap-1 mb-2"
                style="font-size:13px;">
                <div class="text-warning mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($item->average_rating))
                            ★
                        @else
                            <span class="text-muted">★</span>
                        @endif
                    @endfor
                </div>
                
                <span class="text-muted" style="font-size:12px;">
                    ({{ $item->total_rating }})
                </span>
             </div>

            {{-- HARGA --}}
            <h5 class="fw-bold text-dark mb-0">
                Rp{{ number_format($item->harga, 0, ',', '.') }}
            </h5>
        </div>
    </div>
    <!-- <a href="{{ route('produk.detail', $item->id) }}" class="text-decoration-none text-dark">
    </a> -->
</div>