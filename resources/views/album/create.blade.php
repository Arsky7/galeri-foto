@extends('layouts.app')

@section('title', 'Buat Album')

@section('content')

<style>
    .create-album-container {
        animation: slideInUp 0.6s ease;
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .album-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(52, 152, 219, 0.15);
        overflow: hidden;
        position: relative;
    }
    
    .album-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #3498db, #2c3e50, #3498db);
        background-size: 200% 100%;
        animation: gradientSlide 3s ease infinite;
    }
    
    @keyframes gradientSlide {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .album-header {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        padding: 2.5rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .album-header::before {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -50px;
    }
    
    .album-icon {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }
    
    .form-floating-custom {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-floating-custom label {
        color: #2c3e50;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-floating-custom .form-control,
    .form-floating-custom textarea {
        border: 2px solid #e0e6ed;
        border-radius: 12px;
        padding: 0.875rem 1rem;
        transition: all 0.3s ease;
        background: white;
        font-size: 0.95rem;
    }
    
    .form-floating-custom .form-control:focus,
    .form-floating-custom textarea:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        outline: none;
    }
    
    .form-floating-custom textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    .btn-gradient-primary {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        border: none;
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }
    
    .btn-gradient-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: white;
    }
    
    .btn-outline-custom {
        border: 2px solid #3498db;
        color: #3498db;
        background: transparent;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-outline-custom:hover {
        background: #3498db;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }
    
    .char-counter {
        font-size: 0.85rem;
        color: #7f8c8d;
        text-align: right;
        margin-top: 0.25rem;
    }
    
    .required-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.125rem 0.5rem;
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }
</style>

<div class="create-album-container">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            
            <div class="album-card">
                <!-- Header -->
                <div class="album-header">
                    <div class="album-icon">
                        <i class="bi bi-folder-plus" style="font-size: 2rem;"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Buat Album Baru</h2>
                    <p class="mb-0 opacity-90">Organisir foto-foto Anda dalam album yang terstruktur</p>
                </div>
                
                <!-- Form Body -->
                <div class="p-4 bg-white">
                    <form action="{{ route('album.store') }}" method="POST" id="albumForm">
                        @csrf
                        
                        <!-- Nama Album -->
                        <div class="form-floating-custom">
                            <label>
                                <i class="bi bi-folder text-primary"></i>
                                Nama Album
                                <span class="required-badge">
                                    <i class="bi bi-asterisk" style="font-size: 0.6rem;"></i>
                                    Wajib
                                </span>
                            </label>
                            <input type="text" 
                                   name="NamaAlbum" 
                                   id="namaAlbum"
                                   class="form-control @error('NamaAlbum') is-invalid @enderror" 
                                   value="{{ old('NamaAlbum') }}"
                                   placeholder="Contoh: Liburan Bali 2024, Wisuda, Pernikahan..."
                                   maxlength="100"
                                   required>
                            <div class="char-counter">
                                <span id="charCount">0</span>/100 karakter
                            </div>
                            @error('NamaAlbum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Deskripsi -->
                        <div class="form-floating-custom">
                            <label>
                                <i class="bi bi-card-text text-primary"></i>
                                Deskripsi Album
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">Opsional</span>
                            </label>
                            <textarea name="Deskripsi" 
                                      id="deskripsi"
                                      class="form-control @error('Deskripsi') is-invalid @enderror" 
                                      placeholder="Ceritakan tentang album ini... Kapan, dimana, dan momen apa yang diabadikan"
                                      maxlength="500">{{ old('Deskripsi') }}</textarea>
                            <div class="char-counter">
                                <span id="descCharCount">0</span>/500 karakter
                            </div>
                            @error('Deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Info Card -->
                        <div class="alert alert-light border-0" style="background: linear-gradient(135deg, #ebf4f5 0%, #b5c6e0 100%); border-radius: 12px;">
                            <div class="d-flex align-items-start gap-3">
                                <i class="bi bi-lightbulb text-primary" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="fw-bold mb-2 text-primary">Tips Membuat Album</h6>
                                    <ul class="mb-0 small" style="line-height: 1.8;">
                                        <li>Gunakan nama yang deskriptif dan mudah diingat</li>
                                        <li>Kelompokkan foto berdasarkan tema, acara, atau tanggal</li>
                                        <li>Tambahkan deskripsi untuk konteks yang lebih baik</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('album.index') }}" class="btn btn-outline-custom flex-fill">
                                <i class="bi bi-x-circle"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-gradient-primary flex-fill">
                                <i class="bi bi-check-circle"></i>
                                Buat Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
// Character counter untuk nama album
const namaAlbum = document.getElementById('namaAlbum');
const charCount = document.getElementById('charCount');

if (namaAlbum) {
    namaAlbum.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });
    charCount.textContent = namaAlbum.value.length;
}

// Character counter untuk deskripsi
const deskripsi = document.getElementById('deskripsi');
const descCharCount = document.getElementById('descCharCount');

if (deskripsi) {
    deskripsi.addEventListener('input', function() {
        descCharCount.textContent = this.value.length;
    });
    descCharCount.textContent = deskripsi.value.length;
}
</script>

@endsection