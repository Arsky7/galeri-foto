@extends('layouts.guest')
@section('title', 'Register')
@section('content')
<style>
    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }
    .register-container::before,
    .register-container::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(218,165,32,0.08) 0%, transparent 70%);
        animation: float 20s ease-in-out infinite;
        z-index: -1;
    }
    .register-container::before {
        top: -50%; right: -50%;
    }
    .register-container::after {
        bottom: -50%; left: -50%;
        background: radial-gradient(circle, rgba(255,215,0,0.05) 0%, transparent 70%);
        animation: float 25s ease-in-out infinite reverse;
    }

    .register-card {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 3rem;
        max-width: 700px;
        width: 100%;
        box-shadow:
            0 25px 80px rgba(0,0,0,0.6),
            0 0 1px rgba(218,165,32,0.3),
            inset 0 1px 1px rgba(255,215,0,0.1);
        border: 1px solid rgba(218,165,32,0.2);
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease-out;
    }

    .register-header { text-align: center; margin-bottom: 2.5rem; }
    .register-icon {
        width: 90px; height: 90px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 50%, #B8860B 100%);
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 40px rgba(218,165,32,0.4), 0 0 60px rgba(255,215,0,0.2);
        position: relative;
        animation: glow 3s ease-in-out infinite;
    }
    .register-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 50%, #FFF8DC 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }
    .register-subtitle { color: #b8b8b8; font-size: 1rem; font-weight: 300; }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .form-group-custom { margin-bottom: 1.5rem; }
    .form-label-custom {
        font-weight: 600;
        color: #DAA520;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .form-label-custom i { color: #FFD700; font-size: 1.1rem; }
    .required-star { color: #ff6b6b; margin-left: 0.25rem; }

    .form-control-custom {
        width: 100%;
        padding: 1rem 1.25rem;
        background: rgba(255,255,255,0.03);
        border: 2px solid rgba(218,165,32,0.2);
        border-radius: 12px;
        font-size: 0.95rem;
        color: #ffffff;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    textarea.form-control-custom {
        resize: vertical;
        min-height: 80px;
    }
    .form-control-custom::placeholder { color: rgba(255,255,255,0.3); }
    .form-control-custom:focus {
        background: rgba(255,255,255,0.05);
        border-color: #DAA520;
        box-shadow: 0 0 0 4px rgba(218,165,32,0.1), 0 0 20px rgba(255,215,0,0.15);
        outline: none;
        transform: translateY(-2px);
    }

    .input-group-custom { position: relative; }
    .toggle-password {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #DAA520;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        transition: all 0.3s ease;
        z-index: 10;
    }
    .toggle-password:hover {
        color: #FFD700;
        transform: translateY(-50%) scale(1.15);
    }

    .password-strength {
        margin-top: 0.75rem;
        height: 5px;
        background: rgba(255,255,255,0.05);
        border-radius: 3px;
        overflow: hidden;
    }
    .password-strength-bar {
        height: 100%;
        width: 0%;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 3px;
    }

    .btn-register {
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
        transition: all 0.4s ease;
        box-shadow: 0 8px 25px rgba(218,165,32,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        margin-top: 2rem;
    }
    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
    }
    .btn-register:hover::before { left: 100%; }
    .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(218,165,32,0.6);
        background-position: 100% 0;
    }
    .btn-register:active { transform: translateY(-1px); }

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

    .login-link {
        text-align: center;
        padding: 1.75rem;
        background: linear-gradient(135deg, rgba(218,165,32,0.08) 0%, rgba(255,215,0,0.05) 100%);
        border-radius: 12px;
        border: 1px solid rgba(218,165,32,0.15);
        transition: all 0.3s ease;
    }
    .login-link:hover {
        background: linear-gradient(135deg, rgba(218,165,32,0.12) 0%, rgba(255,215,0,0.08) 100%);
        border-color: rgba(218,165,32,0.25);
    }
    .login-link p { color: #b8b8b8; margin: 0; }
    .login-link a {
        color: #FFD700;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .login-link a:hover { color: #DAA520; gap: 0.75rem; }

    .form-hint {
        font-size: 0.8rem;
        color: #888;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        background: rgba(218,165,32,0.15);
        color: #DAA520;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-left: 0.5rem;
    }
    .invalid-feedback {
        color: #ff6b6b;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }

    @media (max-width: 768px) {
        .register-card { padding: 2rem 1.5rem; }
        .register-title { font-size: 1.5rem; }
        .register-icon { width: 70px; height: 70px; }
        .form-row { grid-template-columns: 1fr; gap: 1rem; }
    }
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <div class="register-icon">
                <i class="bi bi-person-plus-fill text-dark" style="font-size: 2.5rem;"></i>
            </div>
            <h3 class="register-title">Buat Akun Baru</h3>
            <p class="register-subtitle">Bergabung bersama kami di GaleriKu</p>
        </div>

        <form action="{{ route('register') }}" method="POST" id="registerForm">
            @csrf
            <div class="form-row">
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-person-circle"></i>
                        Username <span class="required-star">*</span>
                    </label>
                    <input type="text" 
                        name="Username" 
                        class="form-control-custom @error('Username') is-invalid @enderror" 
                        value="{{ old('Username') }}"
                        placeholder="username_anda"
                        required>
                    <div class="form-hint">
                        <i class="bi bi-info-circle"></i> Username unik untuk akun Anda
                    </div>
                    @error('Username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-envelope"></i>
                        Email <span class="required-star">*</span>
                    </label>
                    <input type="email" 
                        name="Email" 
                        class="form-control-custom @error('Email') is-invalid @enderror" 
                        value="{{ old('Email') }}"
                        placeholder="nama@email.com"
                        required>
                    @error('Email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="bi bi-card-text"></i>
                    Nama Lengkap <span class="required-star">*</span>
                </label>
                <input type="text" 
                    name="NamaLengkap" 
                    class="form-control-custom @error('NamaLengkap') is-invalid @enderror" 
                    value="{{ old('NamaLengkap') }}"
                    placeholder="Nama lengkap Anda"
                    required>
                @error('NamaLengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="bi bi-geo-alt"></i>
                    Alamat <span class="badge">Opsional</span>
                </label>
                <textarea name="Alamat" 
                    class="form-control-custom @error('Alamat') is-invalid @enderror" 
                    rows="2"
                    placeholder="Alamat lengkap Anda">{{ old('Alamat') }}</textarea>
                @error('Alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-shield-lock"></i>
                        Password <span class="required-star">*</span>
                    </label>
                    <div class="input-group-custom">
                        <input type="password" 
                            id="password"
                            name="Password" 
                            class="form-control-custom @error('Password') is-invalid @enderror" 
                            placeholder="Minimal 6 karakter"
                            style="padding-right: 3rem;"
                            required>
                        <button type="button" class="toggle-password" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="bi bi-eye-fill" id="toggleIcon1"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    @error('Password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-shield-check"></i>
                        Konfirmasi Password <span class="required-star">*</span>
                    </label>
                    <div class="input-group-custom">
                        <input type="password" 
                            id="passwordConfirm"
                            name="Password_confirmation" 
                            class="form-control-custom" 
                            placeholder="Ketik ulang password"
                            style="padding-right: 3rem;"
                            required>
                        <button type="button" class="toggle-password" onclick="togglePassword('passwordConfirm', 'toggleIcon2')">
                            <i class="bi bi-eye-fill" id="toggleIcon2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-check-circle"></i>
                Daftar Sekarang
            </button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>
        <div class="login-link">
            <p>
                Sudah punya akun? 
                <a href="{{ route('login') }}">
                    Masuk Di Sini <i class="bi bi-arrow-right"></i>
                </a>
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePassword(inputId, iconId) {
    const pwd = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
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

// Password strength indicator
document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('strengthBar');
    if (passwordInput && strengthBar) {
        passwordInput.addEventListener('input', function() {
            const value = this.value;
            let strength = 0;
            if (value.length >= 6) strength += 25;
            if (value.length >= 10) strength += 25;
            if (/[a-z]/.test(value) && /[A-Z]/.test(value)) strength += 25;
            if (/[0-9]/.test(value)) strength += 25;
            strengthBar.style.width = strength + '%';
            if (strength <= 25) {
                strengthBar.style.background = '#e74c3c';
            } else if (strength <= 50) {
                strengthBar.style.background = '#f39c12';
            } else if (strength <= 75) {
                strengthBar.style.background = '#3498db';
            } else {
                strengthBar.style.background = '#27ae60';
            }
        });
    }
});
</script>
@endpush
@endsection