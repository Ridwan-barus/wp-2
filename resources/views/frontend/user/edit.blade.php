@extends('frontend.layout')

@section('title', 'Edit Profil')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid px-5">
    <div class="card p-4 shadow-sm">

        <h3 class="fw-bold mb-4">Edit Profil</h3>
        
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <form action="{{ route('user.update', $user->id) }}" 
              method="POST" 
              enctype="multipart/form-data">
        
            @csrf
            @method('PUT')
        
            <!-- {{-- Foto --}} -->
             <div class="text-center mb-4">
                <img src="{{ asset('storage/img-user/' . ($user->foto ?? 'img-default.jpg')) }}"
                             width="130" class="rounded-circle border mb-3">
        
                <input type="file" name="foto" class="form-control">
             </div>
        
            <!-- {{-- Nama --}} -->
             <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="form-control" autocomplete="name">
             </div>
        
            <!-- {{-- Email --}} -->
             <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" autocomplete="email">
             </div>

             <!-- {{-- Nomor HP --}} -->
             <div class="mb-3">
                <label>Nomor Handphone</label>
                <input type="hp" name="hp" value="{{ old('hp', $user->hp) }}" class="form-control" autocomplete="hp">
             </div>
        
            <!-- {{-- Password --}} -->
             <div class="mb-3">
                <label>Password Baru (Opsional)</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password baru" autocomplete="new-password">
             </div>
        
            <div class="mb-3">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru" autocomplete="new-password">
            </div>
        
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>
        
        </form>
    </div>
</div>



@endsection
