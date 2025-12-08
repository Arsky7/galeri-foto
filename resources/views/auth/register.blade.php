@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<h3 class="fw-bold mb-3">Daftar Akun Baru</h3>
<p class="text-muted mb-4">Bergabung bersama kami</p>

<form action="{{ route('register') }}" method="POST">
    @csrf
    
    <!-- Username -->
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-person-fill"></i> Username
        </label>
        <input type="text" 
               name="Username" 
               class="form-control @error('Username') is-invalid @enderror" 
               value="{{ old('Username') }}"
               placeholder="Pilih username unik"
               required>
        @error('Username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Email -->
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-envelope-fill"></i> Email
        </label>
        <input type="email" 
               name="Email" 
               class="form-control @error('Email') is-invalid @enderror" 
               value="{{ old('Email') }}"
               placeholder="nama@email.com"
               required>
        @error('Email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Nama Lengkap -->
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-card-text"></i> Nama Lengkap
        </label>
        <input type="text" 
               name="NamaLengkap" 
               class="form-control @error('NamaLengkap') is-invalid @enderror" 
               value="{{ old('NamaLengkap') }}"
               placeholder="Nama lengkap Anda"
               required>
        @error('NamaLengkap')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Alamat -->
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-geo-alt-fill"></i> Alamat (Opsional)
        </label>
        <textarea name="Alamat" 
                  class="form-control @error('Alamat') is-invalid @enderror" 
                  rows="2"
                  placeholder="Alamat lengkap">{{ old('Alamat') }}</textarea>
        @error('Alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Password -->
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-lock-fill"></i> Password
        </label>
        <input type="password" 
               name="Password" 
               class="form-control @error('Password') is-invalid @enderror" 
               placeholder="Minimal 6 karakter"
               required>
        @error('Password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Konfirmasi Password -->
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-lock-fill"></i> Konfirmasi Password
        </label>
        <input type="password" 
               name="Password_confirmation" 
               class="form-control" 
               placeholder="Ketik ulang password"
               required>
    </div>
    
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
        <i class="bi bi-person-plus-fill"></i> Daftar Sekarang
    </button>
</form>

<!-- Login Link -->
<div class="text-center mt-4">
    <p class="text-muted">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="text-decoration-none fw-bold">
            Masuk Di Sini
        </a>
    </p>
</div>
@endsection