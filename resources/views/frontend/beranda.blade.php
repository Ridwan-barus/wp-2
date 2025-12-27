@extends('frontend.layout')

@section('content')
<!-- {{-- HERO SECTION --}} -->
<div class="hero-banner position-relative">
  <!-- <div class="overlay text-center container py-5">
    <h1 class="display-5 fw-bold text-white">Koleksi Batik Modern & Elegan</h1>
    <p class="fs-5 text-white">Fashion batik untuk gaya formal & casual. Bahan premium, harga terjangkau.</p>
    <a href="#" class="btn btn-warning btn-lg fw-bold">Belanja Sekarang</a>
  </div> -->
</div>

<!-- {{-- KATEGORI --}} -->
<div class="container-fluid px-5 mt-5">
  <h3 class="fw-bold mb-3">Kategori Populer</h3>
  <div class="row g-4">
    @foreach($kategoris->take(4) as $k)
      <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">

          <img src="{{ $k->gambar
              ? asset('uploads/kategori/'.$k->gambar)
              : asset('images/default-product-img.png') }}" 
              class="card-img-top" 
              style="height:230px; object-fit:contain;">

          <div class="card-body text-center">
            <h5 class="fw-bold">{{ $k->nama }}</h5>

            <a href="{{ route('produk.index', ['kategoris' => $k->id]) }}" 
                class="btn btn-outline-primary mt-2">
              Lihat Produk
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<!-- {{-- PRODUK UNGGULAN --}} -->
<div class="container-fluid px-5">
  <h3 class="fw-bold mt-5 mb-3">Produk Unggulan</h3>
  <div class="row g-4">
    @foreach($produk as $p)
      @include('frontend.components.card-produk', ['item' => $p])
    @endforeach
  </div>
</div>

<!-- {{-- BANNER PROMOSI --}} -->
<div class="container-fluid px-5">
  
</div>

<!-- {{-- KOLEKSI TERBARU --}} -->
<div class="container-fluid px-5">
  <h3 class="fw-bold mt-5 mb-3">Koleksi Terbaru</h3>
  <div class="row g-4">
    @foreach($produkTerbaru as $p)
      @include('frontend.components.card-produk', ['item' => $p])
    @endforeach
  </div>
</div>

<!-- {{-- TESTIMONI PELANGGAN --}} -->
<div class="container-fluid p-5 mt-5"
      style="background:#fff8db; border-radius:15px;">

    <h3 class="text-center fw-bold mb-4">Apa Kata Pelanggan?</h3>

    <div id="testimoniCarousel" class="carousel slide" data-bs-ride="carousel">
      <!-- SLIDES -->
       <div class="carousel-inner">

        @foreach($testimoni as $index => $t)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
          <div class="d-flex justify-content-center">

            <div class="p-4 text-center" style="max-width: 500px; background:transparent;">
              
              <img src="{{ $t->user->foto
                  ? asset('storage/img-user/' . $t->user->foto)
                  : asset('storage/img-user/img-default.jpg') }}"
                  class="rounded-circle mx-auto mb-3" 
                  style="width:80px; height:80px; object-fit:cover;">
              
              <h5 class="fw-bold">{{ $t->user->nama }}</h5>

              <div class="text-warning mb-2">
                @for($i=0; $i<$t->rating; $i++)
                    ★
                @endfor
              </div>

              <p class="text-muted">{{ $t->isi }}</p>

            </div>
          </div>
        </div>
        @endforeach

       </div>

      <!-- BUTTON LEFT -->
      <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" style="filter: invert(1);"></span>
      </button>

      <!-- BUTTON RIGHT -->
      <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" style="filter: invert(1);"></span>
      </button>

    </div>

    <!-- LIHAT SEMUA  -->
     <div class="text-center mt-4">
      <a href="{{ route('testimoni.index') }}"
        class="btn btn-outline-dark px-4 py-2 rounded-pill fw-semibold"
        style="background: white;">
      Lihat Semua Testimoni</a>
     </div>
</div>


<!-- {{-- CTA PROMO --}} -->
<div class="mt-5 p-5 text-center bg-dark text-white rounded shadow-sm">
  <h2 class="fw-bold">Diskon 30% untuk Koleksi Terbaru!</h2>
  <p class="mb-3">Promo terbatas untuk pelanggan baru. Dapatkan batik terbaik dengan harga spesial.</p>
  <a href="#" class="btn btn-warning btn-lg fw-bold">Mulai Belanja</a>
</div>


<style>
  .hero-banner {
    background: url("/images/banner-header.jpeg") center/cover no-repeat;
    min-height: 46vh;
  }

  .hero-banner .overlay {
    backdrop-filter: brightness(0.4);
    border-radius: 12px;
  }
</style>


@endsection

