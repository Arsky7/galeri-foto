@extends('layouts.app')

@section('title', 'Upload Foto')

@section('content')

<style>
    .upload-container {
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
    
    .upload-header {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        border-radius: 20px;
        padding: 2.5rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(52, 152, 219, 0.2);
    }
    
    .upload-header::before {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -50px;
    }
    
    .upload-icon {
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
    
    .upload-card {
        background: white;
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .preview-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .preview-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #3498db, #2c3e50, #3498db);
        background-size: 200% 100%;
        animation: gradientSlide 3s ease infinite;
    }
    
    @keyframes gradientSlide {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .preview-label {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.05rem;
    }
    
    .preview-label i {
        color: #3498db;
    }
    
    .preview-box {
        background: white;
        border: 3px dashed #cbd5e0;
        border-radius: 16px;
        min-height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .preview-box.has-image {
        border-style: solid;
        border-color: #3498db;
    }
    
    .preview-placeholder {
        text-align: center;
        color: #7f8c8d;
        transition: all 0.3s ease;
    }
    
    .preview-placeholder i {
        font-size: 5rem;
        margin-bottom: 1rem;
        opacity: 0.5;
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    
    #previewImage {
        max-height: 450px;
        width: auto;
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }
    
    .form-section {
        padding: 2rem;
    }
    
    .form-group-custom {
        margin-bottom: 1.75rem;
    }
    
    .form-label-custom {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }
    
    .form-label-custom i {
        color: #3498db;
    }
    
    .required-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.125rem 0.5rem;
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    
    .form-control-custom,
    .form-select-custom,
    textarea.form-control-custom {
        border: 2px solid #e0e6ed;
        border-radius: 12px;
        padding: 0.875rem 1rem;
        transition: all 0.3s ease;
        background: white;
        font-size: 0.95rem;
    }
    
    .form-control-custom:focus,
    .form-select-custom:focus,
    textarea.form-control-custom:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        outline: none;
    }
    
    textarea.form-control-custom {
        resize: vertical;
        min-height: 120px;
    }
    
    .file-input-wrapper {
        position: relative;
    }
    
    .file-input-custom {
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .file-input-custom:hover {
        border-color: #3498db;
        background: linear-gradient(135deg, #ebf4f5 0%, #b5c6e0 100%);
        transform: translateY(-2px);
    }
    
    .file-input-custom input[type="file"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }
    
    .file-hint {
        font-size: 0.85rem;
        color: #7f8c8d;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }
    
    .char-counter {
        font-size: 0.85rem;
        color: #7f8c8d;
        text-align: right;
        margin-top: 0.25rem;
    }
    
    .alert-custom {
        border: none;
        border-radius: 12px;
        padding: 1.25rem;
        background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
        border-left: 4px solid #ffc107;
    }
    
    .alert-custom i {
        font-size: 1.25rem;
        margin-right: 0.5rem;
    }
    
    .alert-custom a {
        color: #2c3e50;
        font-weight: 700;
        text-decoration: underline;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .btn-cancel {
        flex: 1;
        border: 2px solid #3498db;
        color: #3498db;
        background: transparent;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-cancel:hover {
        background: #3498db;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }
    
    .btn-upload {
        flex: 1;
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-upload:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    }
    
    .btn-upload:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    .tips-card {
        background: linear-gradient(135deg, #ebf4f5 0%, #b5c6e0 100%);
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 2rem;
    }
    
    .tips-card h6 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .tips-card ul {
        margin: 0;
        padding-left: 1.25rem;
    }
    
    .tips-card li {
        color: #2c3e50;
        line-height: 1.8;
        margin-bottom: 0.5rem;
    }
</style>

<div class="upload-container">
    <!-- Header -->
    <div class="upload-header position-relative">
        <div class="upload-icon">
            <i class="bi bi-cloud-upload-fill text-white" style="font-size: 2rem;"></i>
        </div>
        <h2 class="fw-bold mb-2">Upload Foto Baru</h2>
        <p class="mb-0 opacity-90">Bagikan momen indah Anda dengan dunia</p>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="upload-card">
                <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    
                    <!-- Preview Section -->
                    <div class="preview-section">
                        <div class="preview-label">
                            <i class="bi bi-image"></i>
                            Preview Foto
                        </div>
                        <div class="preview-box" id="previewBox">
                            <div class="preview-placeholder" id="previewPlaceholder">
                                <i class="bi bi-camera"></i>
                                <h5>Belum ada foto dipilih</h5>
                                <p>Pilih file foto untuk melihat preview</p>
                            </div>
                            <img id="previewImage" src="" alt="Preview" class="d-none">
                        </div>
                    </div>
                    
                    <!-- Form Section -->
                    <div class="form-section">
                        
                        <!-- File Upload -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-upload"></i>
                                Pilih Foto
                                <span class="required-badge">
                                    <i class="bi bi-asterisk" style="font-size: 0.6rem;"></i>
                                    Wajib
                                </span>
                            </label>
                            <div class="file-input-wrapper">
                                <div class="file-input-custom">
                                    <i class="bi bi-cloud-arrow-up" style="font-size: 2.5rem; color: #3498db;"></i>
                                    <p class="mb-2 fw-bold">Klik untuk memilih foto</p>
                                    <p class="text-muted small mb-0">atau drag & drop file disini</p>
                                    <input type="file" 
                                           name="foto" 
                                           id="fotoInput"
                                           class="@error('foto') is-invalid @enderror" 
                                           accept="image/*"
                                           required>
                                </div>
                            </div>
                            <div class="file-hint">
                                <i class="bi bi-info-circle"></i>
                                Format: JPG, PNG, GIF • Maksimal: 5MB
                            </div>
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Judul Foto -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-type"></i>
                                Judul Foto
                                <span class="required-badge">
                                    <i class="bi bi-asterisk" style="font-size: 0.6rem;"></i>
                                    Wajib
                                </span>
                            </label>
                            <input type="text" 
                                   name="JudulFoto" 
                                   id="judulFoto"
                                   class="form-control-custom @error('JudulFoto') is-invalid @enderror" 
                                   value="{{ old('JudulFoto') }}"
                                   placeholder="Contoh: Sunset di Pantai Kuta, Pemandangan Gunung Bromo..."
                                   maxlength="150"
                                   required>
                            <div class="char-counter">
                                <span id="judulCount">0</span>/150 karakter
                            </div>
                            @error('JudulFoto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Deskripsi -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-card-text"></i>
                                Deskripsi Foto
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">Opsional</span>
                            </label>
                            <textarea name="DeskripsiFoto" 
                                      id="deskripsiFoto"
                                      class="form-control-custom @error('DeskripsiFoto') is-invalid @enderror" 
                                      placeholder="Ceritakan tentang foto ini... Dimana, kapan, dan momen apa yang diabadikan"
                                      maxlength="500">{{ old('DeskripsiFoto') }}</textarea>
                            <div class="char-counter">
                                <span id="deskripsiCount">0</span>/500 karakter
                            </div>
                            @error('DeskripsiFoto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Pilih Album -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-folder"></i>
                                Pilih Album
                                <span class="required-badge">
                                    <i class="bi bi-asterisk" style="font-size: 0.6rem;"></i>
                                    Wajib
                                </span>
                            </label>
                            
                            @if($albums->count() > 0)
                            <select name="AlbumID" class="form-select-custom @error('AlbumID') is-invalid @enderror" required>
                                <option value="">-- Pilih Album --</option>
                                @foreach($albums as $album)
                                <option value="{{ $album->AlbumID }}" {{ old('AlbumID') == $album->AlbumID ? 'selected' : '' }}>
                                    {{ $album->NamaAlbum }}
                                </option>
                                @endforeach
                            </select>
                            @error('AlbumID')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @else
                            <div class="alert-custom">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <strong>Anda belum memiliki album!</strong><br>
                                Silakan <a href="{{ route('album.create') }}">buat album terlebih dahulu</a> sebelum upload foto.
                            </div>
                            @endif
                        </div>
                        
                        <!-- Tips Card -->
                        <div class="tips-card">
                            <h6>
                                <i class="bi bi-lightbulb-fill text-warning"></i>
                                Tips Upload Foto yang Baik
                            </h6>
                            <ul>
                                <li>Gunakan foto dengan resolusi yang baik untuk hasil optimal</li>
                                <li>Beri judul yang deskriptif dan menarik</li>
                                <li>Tambahkan deskripsi untuk menceritakan konteks foto</li>
                                <li>Pastikan foto sudah masuk ke album yang sesuai</li>
                            </ul>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('foto.index') }}" class="btn-cancel">
                                <i class="bi bi-x-circle"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn-upload" {{ $albums->count() == 0 ? 'disabled' : '' }}>
                                <i class="bi bi-cloud-upload"></i>
                                Upload Foto
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Preview gambar sebelum upload
const fotoInput = document.getElementById('fotoInput');
const previewBox = document.getElementById('previewBox');
const previewPlaceholder = document.getElementById('previewPlaceholder');
const previewImage = document.getElementById('previewImage');

fotoInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewPlaceholder.classList.add('d-none');
            previewImage.src = e.target.result;
            previewImage.classList.remove('d-none');
            previewBox.classList.add('has-image');
        }
        reader.readAsDataURL(file);
    }
});

// Character counter untuk judul
const judulFoto = document.getElementById('judulFoto');
const judulCount = document.getElementById('judulCount');

if (judulFoto) {
    judulFoto.addEventListener('input', function() {
        judulCount.textContent = this.value.length;
    });
    judulCount.textContent = judulFoto.value.length;
}

// Character counter untuk deskripsi
const deskripsiFoto = document.getElementById('deskripsiFoto');
const deskripsiCount = document.getElementById('deskripsiCount');

if (deskripsiFoto) {
    deskripsiFoto.addEventListener('input', function() {
        deskripsiCount.textContent = this.value.length;
    });
    deskripsiCount.textContent = deskripsiFoto.value.length;
}

// Drag and drop support
const fileInputCustom = document.querySelector('.file-input-custom');

fileInputCustom.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.style.borderColor = '#3498db';
    this.style.background = 'linear-gradient(135deg, #ebf4f5 0%, #b5c6e0 100%)';
});

fileInputCustom.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.style.borderColor = '#cbd5e0';
    this.style.background = 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)';
});

fileInputCustom.addEventListener('drop', function(e) {
    e.preventDefault();
    this.style.borderColor = '#cbd5e0';
    this.style.background = 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)';
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fotoInput.files = files;
        fotoInput.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection