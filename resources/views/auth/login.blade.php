@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<h3 class="fw-bold mb-3">Selamat Datang!</h3>
<p class="text-muted mb-4">Masuk ke akun Anda</p>

<form action="{{ route('login') }}" method="POST">
    @csrf
    
    <!-- Username/Email -->
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-person-fill"></i> Username atau Email
        </label>
        <input type="text" 
               name="login" 
               class="form-control @error('login') is-invalid @enderror" 
               value="{{ old('login') }}"
               placeholder="Masukkan username atau email"
               required>
        @error('login')
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
               placeholder="Masukkan password"
               required>
        @error('Password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Remember Me -->
    <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">
            Ingat saya
        </label>
    </div>
    
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
        <i class="bi bi-box-arrow-in-right"></i> Masuk
    </button>
</form>

<!-- Register Link -->
<div class="text-center mt-4">
    <p class="text-muted">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="text-decoration-none fw-bold">
            Daftar Sekarang
        </a>
    </p>
</div>
@endsection