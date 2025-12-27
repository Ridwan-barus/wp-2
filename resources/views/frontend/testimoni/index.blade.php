@extends('frontend.layout')

@section('content')

<div class="container py-5">

    <!-- Judul -->
    <h2 class="fw-bold text-center mb-4">Semua Testimoni Pelanggan</h2>

    <!-- Grid Testimoni -->
    <div class="row g-4">

        @foreach($testimoni as $t)
        <div class="col-md-4">
            <div class="p-4 shadow-sm rounded text-center bg-white">

                <!-- Foto User -->
                <img src="{{ $t->user->foto 
                    ? asset('storage/img-user/' . $t->user->foto) 
                    : asset('storage/img-user/img-default.jpg') }}"
                    class="rounded-circle mb-3"
                    style="width:80px; height:80px; object-fit:cover;">

                <!-- Nama -->
                <h5 class="fw-bold">{{ $t->user->nama }}</h5>

                <!-- Rating -->
                <div class="text-warning mb-2">
                    @for($i=0; $i<$t->rating; $i++)
                        ★
                    @endfor
                </div>

                <!-- Isi Testimoni -->
                <p class="text-muted">
                    "{{ $t->isi }}"
                </p>

            </div>
        </div>
        @endforeach

    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $testimoni->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection
