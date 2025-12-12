@extends('layouts.guest')

@section('title', 'Register')

@section('content')

<style>
    .register-container {
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
    
    .register-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }
    
    .register-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .register-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(52, 152, 219, 0.3);
    }
    
    .register-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .register-subtitle {
        color: #7f8c8d;
        font-size: 1rem;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
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
    
    .required-star {
        color: #e74c3c;
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
    
    .password-strength {
        margin-top: 0.5rem;
        height: 4px;
        background: #e0e6ed;
        border-radius: 2px;
        overflow: hidden;
    }
    
    .password-strength-bar {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }
    
    .btn-register {
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
    
    .btn-register:hover {
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
    
    .login-link {
        text-align: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, #ebf4f5 0%, #b5c6e0 100%);
        border-radius: 12px;
        margin-top: 1.5rem;
    }
    
    .login-link a {
        color: #3498db;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .login-link a:hover {
        color: #2c3e50;
    }
    
    .form-hint {
        font-size: 0.85rem;
        color: #7f8c8d;
        margin-top: 0.25rem;
    }
</style>

<div class="register-container">
    <div class="register-card">
        <!-- Register Header -->
        <div class="register-header">
            <div class="register-icon">
                <i class="bi bi-person-plus-fill text-white" style="font-size: 2.5rem;"></i>
            </div>
            <h3 class="register-title">Buat Akun Baru</h3>
            <p class="register-subtitle">Bergabung bersama kami di GaleriKu</p>
        </div>

        <form action="{{ route('register') }}" method="POST" id="registerForm">
            @csrf
            
            <!-- Username & Email -->
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
                        <div class="invalid-feedback d-block">{{ $message }}</div>
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
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Nama Lengkap -->
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
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Alamat -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="bi bi-geo-alt"></i>
                    Alamat <span class="badge bg-light text-dark" style="font-size: 0.7rem;">Opsional</span>
                </label>
                <textarea name="Alamat" 
                          class="form-control-custom @error('Alamat') is-invalid @enderror" 
                          rows="2"
                          placeholder="Alamat lengkap Anda">{{ old('Alamat') }}</textarea>
                @error('Alamat')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Password & Konfirmasi -->
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
                        <div class="invalid-feedback d-block">{{ $message }}</div>
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
            
            <!-- Submit Button -->
            <button type="submit" class="btn-register">
                <i class="bi bi-check-circle"></i>
                Daftar Sekarang
            </button>
        </form>

        <!-- Divider -->
        <div class="divider">
            <span>atau</span>
        </div>

        <!-- Login Link -->
        <div class="login-link">
            <p class="mb-0">
                Sudah punya akun? 
                <a href="{{ route('login') }}">
                    Masuk Di Sini <i class="bi bi-arrow-right"></i>
                </a>
            </p>
        </div>
    </div>
</div>

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
</script>

@endsection