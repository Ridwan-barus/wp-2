<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $judul ?? 'Toko Batik' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light py-3 shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('beranda') }}">
      <img src="{{ asset('images/logo.png') }}" alt="My Batik" style="height: 40px; margin-right: 10px;">
      <span class="ms-1">MyBatik</span>
    </a>

    <div class="d-flex align-items-center ms-auto">
      <a href="{{ route('produk.index') }}" class="btn btn-link">Produk</a>
      <!-- <a href="{{ route('cart.view') }}" class="btn btn-link">Keranjang</a> -->
      <div class="d-flex align-items-center">
        <a href="{{ route('likes.index') }}" 
          class="bi bi-heart-fill fs-3 d-flex align-items-center text-danger me-3"
          style="line-height: 1; text-decoration: none;">
        </a>
      </div>
      @auth
      <div class="d-flex align-items-center">
        <a href="{{ route('orders.index') }}" 
          class="bi bi-bag-fill fs-3 d-flex align-items-center"
          style="line-height: 1; text-decoration: none;"></a>
      </div>
        @if (Auth::user()->role == 1)
          <a href="{{ route('admin') }}" class="btn btn-link">Dashboard</a>
        @endif
      @endauth
      
      <ul class="navbar-nav flex-row">

        <!-- {{-- Jika BELUM login --}} -->
        @guest
          <li class="nav-item ms-3">
            <a href="{{ route('login') }}" class="btn btn-primary px-3">
                Login
            </a>
          </li>
        @endguest

        <!-- {{-- Jika SUDAH login --}} -->
        @auth
          <li class="nav-item dropdown ms-3">
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" 
              href="#" data-bs-toggle="dropdown" aria-expanded="false">
               
              @if (Auth::user()->foto)
                <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" 
                alt="user" class="rounded-circle" width="31">
              @else
                <img src="{{ asset('storage/img-user/img-default.jpg') }}" 
                alt="user" class="rounded-circle" width="31">
              @endif
            </a>
            
            <!-- NAVBAR -->
            <ul class="dropdown-menu dropdown-menu-end user-dd animated">
              <!-- PROFIL USER -->
              <li>
                <a class="dropdown-item" 
                  href="{{ route('user.edit', Auth::user()->id) }}">
                  <i class="ti-user me-2"></i> Profil Saya
                </a>
              </li>

              <!-- TESTIMONI FORM -->
              <li>
                <a class="dropdown-item" 
                  href="{{ route('testimoni.create') }}">
                  <i class="ti-user me-2"></i> Kirim Testimoni
                </a>
              </li>

              <!-- LOGOUT -->
              <li>
                <a class="dropdown-item" href="#"
                  onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">
                  <i class="fa fa-power-off me-2"></i> Keluar
                </a>
              </li>
            </ul>
          </li>

          <!-- {{-- Form Logout --}} -->
          <form id="keluar-app" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        @endauth

      </ul>

    </div>
  </div>
</nav>

<div class="container-fluid p-0 my-4">
  @yield('content')
</div>

<!-- FOOTER -->
<footer class="mt-5 pt-5 pb-4 text-white" style="background:#1f1f1f; width:100%;">
    <div class="container-fluid px-5">

        <div class="row g-5">

            <!-- CONTACT INFO -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">CONTACT INFO</h5>

                <p class="mb-1 text-uppercase text-secondary small">ADDRESS:</p>
                <p class="text-white">
                    CEMANI – GROGOL, Kel. Cemani, Kec. Grogol, Kab.<br>
                    Sukoharjo, Prov. Jawa Tengah
                </p>

                <p class="mb-1 text-uppercase text-secondary small">PHONE:</p>
                <p class="text-white">0271 717500</p>

                <p class="mb-1 text-uppercase text-secondary small">EMAIL:</p>
                <p class="text-white">mybatik@batik.co.id</p>

                <div class="p-3 mt-3" style="border-left:4px solid #777;">
                    <small class="text-secondary">
                        Layanan Pengaduan Konsumen Direktorat Jenderal Perlindungan Konsumen
                        dan Tata Tertib Negara Kementerian Perdagangan RI<br>
                        Nomor Whatsapp Ditjen PKTN 0853-1111-1010
                    </small>
                </div>

                <!-- Sosial Media -->
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-x"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- PANDUAN -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">PANDUAN</h5>

                <ul class="list-unstyled text-secondary">
                    <li>
                      <a href="{{ route('produk.index', ['kategoris' => 'semua']) }}" 
                          class="text-decoration-none
                          {{ request()->routeIs('produk.index') &&
                            (!request('kategoris') || request('kategoris') == 'semua')
                            ? 'text-light' 
                            : 'text-secondary' }}">
                          › Kategori
                      </a>
                    </li>
                    
                    <ul class="list-unstyled ms-3">
                      @foreach($kategoris as $k)
                        <li>
                          <a href="{{ route('produk.index', ['kategoris' => $k->id]) }}" 
                              class="text-decoration-none 
                              {{ request()->routeIs('produk.index') && request('kategoris') == $k->id 
                                ? 'text-light' 
                                : 'text-secondary' }}">
                              › {{ $k->nama }}
                          </a>
                        </li>
                        <!-- <li><a href="#" class="text-secondary text-decoration-none">› Batik Couple</a></li> -->
                      @endforeach
                    </ul>
                </ul>
            </div>

            <!-- BANTUAN -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">BANTUAN</h5>

                <ul class="list-unstyled text-secondary">
                  <li class="mt-2">
                    <a href="{{ route('syarat-ketentuan') }}"
                      class="text-decoration-none
                      {{ request()->routeIs('syarat-ketentuan')
                          ? 'text-light'
                          : 'text-secondary' }}">
                      › Syarat dan Ketentuan
                    </a>
                  </li>
                </ul>

                <!-- Pembayaran -->
                <div class="mt-4">
                    <h6 class="fw-bold">Pembayaran :</h6>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <img src="{{ asset('images/payment/visa.png') }}" style="height:35px;">
                        <img src="{{ asset('images/payment/mastercard.png') }}" style="height:35px;">
                        <img src="{{ asset('images/payment/bca.png') }}" style="height:35px;">
                        <img src="{{ asset('images/payment/mandiri.png') }}" style="height:35px;">
                        <img src="{{ asset('images/payment/permatabank.png') }}" style="height:35px;">
                    </div>
                </div>

                <!-- Pengiriman -->
                <div class="mt-4">
                    <h6 class="fw-bold">Pengiriman :</h6>
                    <div class="d-flex gap-3 mt-2">
                        <img src="{{ asset('images/shipping/jne.png') }}" style="height:40px;">
                    </div>
                </div>

            </div>

        </div>

        <hr class="border-secondary my-4">

        <p class="text-center text-secondary mb-0">© {{ date('Y') }} MyBatik — All Rights Reserved.</p>

    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.wishlist-btn');
    if (!btn) return;

    // const isWishlistPage = document.body.classList.contains('wishlist-page');
    // if (!isWishlistPage) return;

    e.preventDefault();
    e.stopPropagation();

    if (btn.dataset.loading === 'true') return;
    btn.dataset.loading = 'true';

    const productId = btn.dataset.id;
    const icon = btn.querySelector('i');

    fetch(`/produk/${productId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {

        // toggle icon
        icon.classList.toggle('bi-heart-fill', data.liked);
        icon.classList.toggle('text-danger', data.liked);
        icon.classList.toggle('bi-heart', !data.liked);

        // 🔥 kalau di halaman wishlist & di-unlike → hapus card
        if (data.action === 'removed') {
            const item = document.getElementById('wishlist-' + productId);
            if (item) item.remove();

            // kalau kosong
            if (document.getElementById('wishlist-page')) {

                if (document.querySelectorAll('.wishlist-item').length === 0) {
                    document.getElementById('wishlist-page').innerHTML = `
                        <div class="text-center py-5">
                            <i class="bi bi-heart" style="font-size:60px;"></i>
                            <p class="mt-3 text-muted">Belum ada produk yang kamu sukai.</p>
                        </div>
                    `;
                }

            }
        }
    })
    .finally(() => {
        btn.dataset.loading = 'false';
    });
});
</script>


</body>

<style>
  .product-image {
    transition: 0.3s ease;
  }

  .hover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0);   /* default transparan */
    transition: background 0.3s ease;
    border-radius: 4px;
  }

  /* efek ketika hover */
  .card:hover .hover-overlay {
    background: rgba(0,0,0,0.25); /* gelap halus */
  }

  .card:hover .product-image {
    transform: scale(1.02); /* sedikit zoom biar modern */
  }

  .card {
    cursor: pointer; /* biar tau bisa diklik */
  }


  .btn-primary:hover {
    background-color:#0046bd;
  }
  .btn-outline-danger:hover {
    background-color:#ffeded;
  }
</style>



<!-- sweetalert -->
<script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
<!-- sweetalert END -->
<!-- sweetalert success -->
@if (session('success'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}"
  });
</script>
@endif
<!-- konfirmasi success END -->

<!-- <script>
  document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', () => {
      window.location = card.dataset.url;
    });
  });
</script> -->



</html>
