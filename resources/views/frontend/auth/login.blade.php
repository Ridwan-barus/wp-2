@extends('frontend.layout')

@section('content')

<div class="col-md-4 mx-auto p-4 bg-white border rounded shadow">

    <h4 class="text-center fw-bold mb-3">Login</h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- TOMBOL LOGIN -->
    <form method="POST" action="{{ route('login.process') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Masuk</button>
    </form>

    <!-- TOMBOL REGISTER -->
     <div class="text-center mt-3">
        <span class="text-muted">Belum punya akun?<a href="{{ route('register') }}" class="btn btn-link" style="text-decoration: none;">Daftar Sekarang</a></span>
     </div>

</div>

@endsection
