@extends('frontend.layout')

@section('content')

<div class="col-md-5 mx-auto p-4 bg-white border rounded shadow">

    <h3 class="text-center fw-bold mb-3">Daftar Akun Baru</h3>

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="m-0 ps-3">
              @foreach ($errors->all() as $e)
                  <li>{{ $e }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Daftar</button>

    </form>

    <div class="text-center mt-3">
        <span class="text-muted">Sudah punya akun?</span><br>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary mt-2">
            Login Sekarang
        </a>
    </div>

</div>

@endsection
