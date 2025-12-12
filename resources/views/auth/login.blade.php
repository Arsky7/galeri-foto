@extends('layouts.guest')

@section('title', 'Login')

@section('content')

<style>
    .login-container {
        animation: fadeInUp 0.8s ease;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }
    
    .welcome-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .welcome-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(52, 152, 219, 0.3);
        animation: pulse 2s ease infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .welcome-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .welcome-subtitle {
        color: #7f8c8d;
        font-size: 1rem;
    }
    
    .form-group-custom {
        margin-bottom: 1.5rem;
    }
    
    .form-label-custom {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-label-custom i {
        color: #3498db;
    }
    
    .input-wrapper {
        position: relative;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e0e6ed;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
    }
    
    .form-control-custom:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        outline: none;
    }
    
    .input-group-custom {
        position: relative;
    }
    
    .toggle-password {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #7f8c8d;
        cursor: pointer;
        padding: 0.5rem;
        transition: all 0.3s ease;
        z-index: 10;
    }
    
    .toggle-password:hover {
        color: #3498db;
        transform: translateY(-50%) scale(1.1);
    }
    
    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .form-check-custom {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-check-custom input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
    
    .btn-login {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        border: none;
        color: white;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    }
    
    .divider {
        display: flex;
        align-items: center;
        margin: 2rem 0;
        color: #7f8c8d;
    }
    
    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e0e6ed;
    }
    
    .divider span {
        padding: 0 1rem;
        font-size: 0.875rem;
    }
    
    .register-link {
        text-align: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, #ebf4f5 0%, #b5c6e0 100%);
        border-radius: 12px;
        margin-top: 1.5rem;
    }
    
    .register-link a {
        color: #3498db;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .register-link a:hover {
        color: #2c3e50;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <!-- Welcome Header -->
        <div class="welcome-header">
            <div class="welcome-icon">
                <i class="bi bi-camera-fill text-white" style="font-size: 2.5rem;"></i>
            </div>
            <h3 class="welcome-title">Selamat Datang Kembali! 👋</h3>
            <p class="welcome-subtitle">Masuk untuk melanjutkan ke GaleriKu</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <!-- Username / Email -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="bi bi-person-circle"></i>
                    Username atau Email
                </label>
                <input type="text"
                    name="login"
                    class="form-control-custom @error('login') is-invalid @enderror"
                    value="{{ old('login') }}"
                    placeholder="Masukkan username atau email Anda"
                    required
                    autofocus>
                @error('login')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="bi bi-shield-lock"></i>
                    Password
                </label>
                <div class="input-group-custom">
                    <input type="password"
                        id="password"
                        name="Password"
                        class="form-control-custom @error('Password') is-invalid @enderror"
                        placeholder="Masukkan password Anda"
                        style="padding-right: 3rem;"
                        required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="bi bi-eye-fill" id="toggleIcon"></i>
                    </button>
                </div>
                @error('Password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="remember-forgot">
                <div class="form-check-custom">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" style="cursor: pointer;">Ingat saya</label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Masuk Sekarang
            </button>
        </form>

        <!-- Divider -->
        <div class="divider">
            <span>atau</span>
        </div>

        <!-- Register Link -->
        <div class="register-link">
            <p class="mb-0">
                Belum punya akun? 
                <a href="{{ route('register') }}">
                    Daftar Sekarang <i class="bi bi-arrow-right"></i>
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