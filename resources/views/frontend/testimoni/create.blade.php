@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">Tulis Testimoni</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('testimoni.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" value="{{ Auth::user()->nama }}" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <select name="rating" class="form-select" required>
                <option value="5">★★★★★</option>
                <option value="4">★★★★☆</option>
                <option value="3">★★★☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="1">★☆☆☆☆</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Testimoni</label>
            <textarea name="isi" class="form-control" rows="4" required></textarea>
        </div>

        <button class="btn btn-primary">Kirim Testimoni</button>
    </form>
</div>
@endsection
