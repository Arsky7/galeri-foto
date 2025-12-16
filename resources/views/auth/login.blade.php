@extends('layouts.guest')
@section('title', 'Login')
@section('content')
<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }
    .login-container::before,
    .login-container::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(218, 165, 32, 0.08) 0%, transparent 70%);
        animation: float 20s ease-in-out infinite;
        z-index: -1;
    }
    .login-container::before {
        top: -50%; right: -50%;
    }
    .login-container::after {
        bottom: -50%; left: -50%;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.05) 0%, transparent 70%);
        animation: float 25s ease-in-out infinite reverse;
    }
    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        33% { transform: translate(30px, -30px) rotate(5deg); }
        66% { transform: translate(-20px, 20px) rotate(-5deg); }
    }

    .login-card {
        background: linear-gradient(135deg, rgba(20, 20, 20, 0.95) 0%, rgba(30, 30, 30, 0.9) 100%);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 3rem;
        max-width: 480px;
        width: 100%;
        box-shadow:
            0 25px 80px rgba(0, 0, 0, 0.6),
            0 0 1px rgba(218, 165, 32, 0.3),
            inset 0 1px 1px rgba(255, 215, 0, 0.1);
        border: 1px solid rgba(218, 165, 32, 0.2);
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease-out;
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .welcome-header { text-align: center; margin-bottom: 2.5rem; }
    .welcome-icon {
        width: 90px; height: 90px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 50%, #B8860B 100%);
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow:
            0 10px 40px rgba(218, 165, 32, 0.4),
            0 0 60px rgba(255, 215, 0, 0.2);
        position: relative;
        animation: glow 3s ease-in-out infinite;
    }
    @keyframes glow {
        0%, 100% { box-shadow: 0 10px 40px rgba(218,165,32,0.4), 0 0 60px rgba(255,215,0,0.2); }
        50%      { box-shadow: 0 10px 50px rgba(218,165,32,0.6), 0 0 80px rgba(255,215,0,0.3); }
    }
    .welcome-icon::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #DAA520, #FFD700, #DAA520);
        border-radius: 22px;
        z-index: -1;
        opacity: 0.3;
        animation: rotate 3s linear infinite;
    }
    @keyframes rotate { 100% { transform: rotate(360deg); } }

    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 50%, #FFF8DC 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }
    .welcome-subtitle {
        color: #b8b8b8;
        font-size: 1rem;
        font-weight: 300;
    }

    .form-group-custom { margin-bottom: 1.5rem; }
    .form-label-custom {
        font-weight: 600;
        color: #DAA520;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .form-label-custom i { color: #FFD700; font-size: 1.1rem; }

    .form-control-custom {
        width: 100%;
        padding: 1rem 1.25rem;
        background: rgba(255, 255, 255, 0.03);
        border: 2px solid rgba(218, 165, 32, 0.2);
        border-radius: 12px;
        font-size: 0.95rem;
        color: #ffffff;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .form-control-custom::placeholder { color: rgba(255,255,255,0.3); }
    .form-control-custom:focus {
        background: rgba(255,255,255,0.05);
        border-color: #DAA520;
        box-shadow:
            0 0 0 4px rgba(218,165,32,0.1),
            0 0 20px rgba(255,215,0,0.15);
        outline: none;
        transform: translateY(-2px);
    }

    .input-group-custom { position: relative; }
    .toggle-password {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #DAA520;
        cursor: pointer;
        padding: 0.5rem;
        transition: all 0.3s ease;
        z-index: 10;
    }
    .toggle-password:hover {
        color: #FFD700;
        transform: translateY(-50%) scale(1.15);
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .form-check-custom {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .form-check-custom input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #DAA520;
    }
    .form-check-custom label {
        color: #b8b8b8;
        cursor: pointer;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }
    .form-check-custom label:hover { color: #DAA520; }

    .btn-login {
        width: 100%;
        padding: 1.1rem;
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 50%, #DAA520 100%);
        background-size: 200% 200%;
        border: none;
        color: #000;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(218, 165, 32, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
    }
    .btn-login:hover::before { left: 100%; }
    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(218,165,32,0.6);
        background-position: 100% 0;
    }
    .btn-login:active { transform: translateY(-1px); }

    .divider {
        display: flex;
        align-items: center;
        margin: 2.5rem 0;
        color: #666;
    }
    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(218,165,32,0.3), transparent);
    }
    .divider span {
        padding: 0 1.5rem;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .register-link {
        text-align: center;
        padding: 1.75rem;
        background: linear-gradient(135deg, rgba(218,165,32,0.08) 0%, rgba(255,215,0,0.05) 100%);
        border-radius: 12px;
        border: 1px solid rgba(218,165,32,0.15);
        transition: all 0.3s ease;
    }
    .register-link:hover {
        background: linear-gradient(135deg, rgba(218,165,32,0.12) 0%, rgba(255,215,0,0.08) 100%);
        border-color: rgba(218,165,32,0.25);
    }
    .register-link p { color: #b8b8b8; margin: 0; }
    .register-link a {
        color: #FFD700;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .register-link a:hover { color: #DAA520; gap: 0.75rem; }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border: 1px solid;
        animation: slideDown 0.4s ease-out;
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        border-color: rgba(220, 53, 69, 0.3);
        color: #ff6b6b;
    }
    .alert-success {
        background: rgba(40, 167, 69, 0.1);
        border-color: rgba(40, 167, 69, 0.3);
        color: #51cf66;
    }
    .btn-close {
        background: transparent;
        border: none;
        color: inherit;
        opacity: 0.6;
        cursor: pointer;
        padding: 0.5rem;
        transition: opacity 0.3s ease;
    }
    .btn-close:hover { opacity: 1; }

    .invalid-feedback {
        color: #ff6b6b;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }

    @media (max-width: 576px) {
        .login-card { padding: 2rem 1.5rem; }
        .welcome-title { font-size: 1.5rem; }
        .welcome-icon { width: 70px; height: 70px; }
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="welcome-header">
            <div class="welcome-icon">
                <i class="bi bi-camera-fill text-dark" style="font-size: 2.5rem;"></i>
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
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
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
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="remember-forgot">
                <div class="form-check-custom">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat saya</label>
                </div>
            </div>
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Masuk Sekarang
            </button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>
        <div class="register-link">
            <p>
                Belum punya akun? 
                <a href="{{ route('register') }}">
                    Daftar Sekarang <i class="bi bi-arrow-right"></i>
                </a>
            </p>
        </div>
    </div>
</div>

@push('scripts')
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
@endpush
@endsection