@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 p-4" style="width: 450px; border-radius: 16px; backdrop-filter: blur(10px);">
        
        <h3 class="fw-bold text-center mb-1">Selamat Datang! 👋</h3>
        <p class="text-muted text-center mb-4">Masuk untuk melanjutkan</p>

        @if (session('error'))
            <div class="alert alert-danger text-center py-2">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <!-- Username / Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-person-fill"></i> Username / Email
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
<div class="mb-3 position-relative">
    <label class="form-label fw-semibold">
        <i class="bi bi-lock-fill"></i> Password
    </label>
    <div class="input-group">
        <input type="password"
            id="password"
            name="Password"
            class="form-control @error('Password') is-invalid @enderror"
            placeholder="Masukkan password"
            required>

        <span class="input-group-text bg-white border-start-0"
              style="cursor:pointer"
              onclick="togglePassword()">
            <i class="bi bi-eye-fill" id="toggleIcon"></i>
        </span>
    </div>

    @error('Password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="btn w-100 py-2 fw-bold"
                style="background: linear-gradient(90deg, #4a90e2, #0077ff); border-radius: 8px; transition: 0.3s;">
                <i class="bi bi-box-arrow-in-right"></i> Masuk
            </button>
        </form>

        <!-- Register Link -->
        <div class="text-center mt-4">
            <p class="text-muted">
                Belum punya akun?
                <a href="{{ route('register') }}" class="fw-semibold text-decoration-none text-primary">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pwd = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");

    if (pwd.type === "password") {
        pwd.type = "text";
        icon.classList.remove("bi-eye-fill");
        icon.classList.add("bi-eye-slash-fill");
    } else {
        pwd.type = "password";
        icon.classList.remove("bi-eye-slash-fill");
        icon.classList.add("bi-eye-fill");
    }
}
</script>

@endsection
