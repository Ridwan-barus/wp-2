@extends('frontend.layout')

@section('title', 'Semua Produk')

@section('content')
<div class="container-fluid px-5 py-4">

    <!-- JUDUL -->
    <!-- <h2 class="fw-bold mb-3 text-center">Semua Produk</h2> -->

    <div class="d-flex justify-content-center flex-wrap gap-2 mb-4">
        <!-- SEMUA -->
        <a href="{{ route('produk.index', ['kategoris' => 'semua']) }}"
        class="btn btn-outline-dark
        {{ request('kategoris') == 'semua' || !request('kategoris') ? 'active' : '' }}">
        Semua
        </a>

        <!-- KATEGORI -->
        @foreach($kategoris as $c)
        <a href="{{ route('produk.index', ['kategoris' => $c->id]) }}"
            class="btn btn-outline-dark
            {{ request('kategoris') == $c->id ? 'active' : '' }}">
            {{ $c->nama }}
        </a>
        @endforeach
    </div>

    <div class="row g-4">
    @forelse($produk as $p)
      @include('frontend.components.card-produk', ['item' => $p])
    @empty
      <div class="col-12 text-center">
        <p class="text-muted">Produk tidak ditemukan.</p>
      </div>
    @endforelse
  </div>

</div>
@endsection