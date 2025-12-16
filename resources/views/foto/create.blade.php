@extends('layouts.app')

@section('title', 'Upload Foto')

@section('content')
<style>
    .upload-container {
        animation: slideInUp 0.6s ease;
    }
    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .upload-header {
        background: linear-gradient(135deg, rgba(15,15,15,0.95) 0%, rgba(25,25,25,0.9) 100%);
        border-radius: 24px;
        padding: 2.8rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 2.5rem;
        border: 1px solid rgba(218,165,32,0.25);
        box-shadow:
            0 15px 50px rgba(0,0,0,0.6),
            inset 0 0 30px rgba(218,165,32,0.1);
    }

    .upload-header::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(218,165,32,0.1) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    .upload-title {
        font-size: 2.3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .upload-subtitle {
        color: rgba(218,165,32,0.85);
        font-size: 1.1rem;
        max-width: 700px;
    }

    .upload-card {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        border-radius: 22px;
        border: 1px solid rgba(218,165,32,0.2);
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        overflow: hidden;
    }

    .preview-section {
        padding: 2rem;
        border-bottom: 1px solid rgba(218,165,32,0.15);
    }

    .section-label {
        font-size: 1.25rem;
        font-weight: 700;
        color: #FFD700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.7rem;
    }

    .preview-box {
        background: rgba(10,10,10,0.6);
        border: 2px dashed rgba(218,165,32,0.3);
        border-radius: 18px;
        min-height: 380px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .preview-box.has-image {
        border-style: solid;
        border-color: rgba(218,165,32,0.5);
        box-shadow: 0 0 30px rgba(218,165,32,0.1);
    }

    .preview-placeholder {
        text-align: center;
        color: #aaa;
        transition: opacity 0.3s ease;
    }
    .preview-placeholder i {
        font-size: 5.5rem;
        color: rgba(218,165,32,0.3);
        margin-bottom: 1.2rem;
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    #previewImage {
        max-height: 450px;
        max-width: 100%;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        animation: fadeIn 0.5s ease;
    }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

    .form-section {
        padding: 2.2rem;
    }

    .form-group-custom {
        margin-bottom: 1.8rem;
    }

    .form-label-custom {
        font-weight: 700;
        color: #FFD700;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 1.05rem;
    }

    .required-badge {
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        color: white;
        font-size: 0.75rem;
        padding: 0.15rem 0.6rem;
        border-radius: 20px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .form-control-custom,
    .form-select-custom,
    textarea.form-control-custom {
        background: rgba(30,30,30,0.7);
        border: 1px solid rgba(218,165,32,0.2);
        border-radius: 12px;
        padding: 0.9rem 1.1rem;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .form-control-custom::placeholder,
    textarea.form-control-custom::placeholder {
        color: rgba(255,255,255,0.4);
    }
    .form-control-custom:focus,
    .form-select-custom:focus,
    textarea.form-control-custom:focus {
        border-color: #DAA520;
        box-shadow: 0 0 0 4px rgba(218,165,32,0.2);
        outline: none;
        background: rgba(35,35,35,0.8);
    }

    textarea.form-control-custom {
        min-height: 130px;
        resize: vertical;
    }

    .file-input-wrapper {
        position: relative;
    }

    .file-input-custom {
        background: linear-gradient(135deg, rgba(218,165,32,0.08) 0%, rgba(255,215,0,0.05) 100%);
        border: 2px dashed rgba(218,165,32,0.3);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .file-input-custom:hover {
        border-color: #DAA520;
        background: linear-gradient(135deg, rgba(218,165,32,0.15) 0%, rgba(255,215,0,0.1) 100%);
        transform: scale(1.02);
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
        color: #999;
        font-size: 0.9rem;
        margin-top: 0.7rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .char-counter {
        color: #999;
        text-align: right;
        margin-top: 0.4rem;
        font-size: 0.9rem;
    }

    .alert-custom {
        background: rgba(218,165,32,0.1);
        border: 1px solid rgba(218,165,32,0.3);
        border-radius: 12px;
        padding: 1.2rem;
        color: #FFD700;
        margin: 1.5rem 0;
    }

    .tips-card {
        background: linear-gradient(135deg, rgba(218,165,32,0.08) 0%, rgba(255,215,0,0.05) 100%);
        border: 1px solid rgba(218,165,32,0.2);
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .tips-card h6 {
        color: #FFD700;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .tips-card ul {
        padding-left: 1.4rem;
        margin: 0;
    }

    .tips-card li {
        color: #ccc;
        line-height: 1.8;
        margin-bottom: 0.6rem;
    }

    .action-buttons {
        display: flex;
        gap: 1.2rem;
        margin-top: 2.2rem;
    }

    .btn-cancel {
        flex: 1;
        background: rgba(218,165,32,0.15);
        color: #FFD700;
        border: 1px solid rgba(218,165,32,0.3);
        padding: 1rem;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-cancel:hover {
        background: rgba(218,165,32,0.3);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(218,165,32,0.2);
    }

    .btn-upload {
        flex: 1;
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #000;
        border: none;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.4s ease;
        box-shadow: 0 8px 25px rgba(218,165,32,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
    }
    .btn-upload:hover:not(:disabled) {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(218,165,32,0.6);
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
    }
    .btn-upload:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        background: #555;
        color: #888;
    }

    @media (max-width: 768px) {
        .action-buttons { flex-direction: column; }
        .upload-header { padding: 2rem 1.5rem; }
        .upload-title { font-size: 1.8rem; }
        .preview-box { min-height: 300px; }
    }
</style>

<div class="upload-container">
    <div class="upload-header">
        <h2 class="upload-title">
            <i class="bi bi-cloud-upload-fill"></i> Upload Foto Baru
        </h2>
        <p class="upload-subtitle">Bagikan momen indah Anda dengan dunia</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="upload-card">
                <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf

                    <div class="preview-section">
                        <h3 class="section-label">
                            <i class="bi bi-eye"></i> Preview Foto
                        </h3>
                        <div class="preview-box" id="previewBox">
                            <div class="preview-placeholder" id="previewPlaceholder">
                                <i class="bi bi-camera"></i>
                                <h5>Belum ada foto dipilih</h5>
                                <p>Pilih file foto untuk melihat preview</p>
                            </div>
                            <img id="previewImage" src="" alt="Preview">
                        </div>
                    </div>

                    <div class="form-section">
                        <!-- File Upload -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-upload"></i> Pilih Foto
                                <span class="required-badge">Wajib</span>
                            </label>
                            <div class="file-input-wrapper">
                                <div class="file-input-custom">
                                    <i class="bi bi-cloud-arrow-up" style="font-size: 2.8rem; color: #DAA520;"></i>
                                    <p class="mb-2 fw-bold">Klik untuk memilih foto</p>
                                    <p class="text-muted small">atau drag & drop file di sini</p>
                                    <input type="file" name="foto" id="fotoInput" accept="image/*" required>
                                </div>
                            </div>
                            <div class="file-hint">
                                <i class="bi bi-info-circle"></i> Format: JPG, PNG, GIF • Maks: 5MB
                            </div>
                            @error('foto')
                                <div class="text-danger mt-2" style="font-size: 0.9rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Judul -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-type"></i> Judul Foto
                                <span class="required-badge">Wajib</span>
                            </label>
                            <input type="text" name="JudulFoto" id="judulFoto" class="form-control-custom" 
                                   value="{{ old('JudulFoto') }}" maxlength="150" required>
                            <div class="char-counter">
                                <span id="judulCount">0</span>/150 karakter
                            </div>
                            @error('JudulFoto')
                                <div class="text-danger mt-2" style="font-size: 0.9rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-card-text"></i> Deskripsi Foto
                                <span class="badge bg-secondary" style="font-size: 0.75rem; padding: 0.25em 0.6em;">Opsional</span>
                            </label>
                            <textarea name="DeskripsiFoto" id="deskripsiFoto" class="form-control-custom" 
                                      maxlength="500">{{ old('DeskripsiFoto') }}</textarea>
                            <div class="char-counter">
                                <span id="deskripsiCount">0</span>/500 karakter
                            </div>
                            @error('DeskripsiFoto')
                                <div class="text-danger mt-2" style="font-size: 0.9rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Album -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-folder"></i> Pilih Album
                                <span class="required-badge">Wajib</span>
                            </label>
                            @if($albums->count() > 0)
                                <select name="AlbumID" class="form-select-custom" required>
                                    <option value="">-- Pilih Album --</option>
                                    @foreach($albums as $album)
                                        <option value="{{ $album->AlbumID }}" {{ old('AlbumID') == $album->AlbumID ? 'selected' : '' }}>
                                            {{ $album->NamaAlbum }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('AlbumID')
                                    <div class="text-danger mt-2" style="font-size: 0.9rem;">{{ $message }}</div>
                                @enderror
                            @else
                                <div class="alert-custom">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <strong>Anda belum memiliki album!</strong><br>
                                    Silakan <a href="{{ route('album.create') }}" style="color: #FFD700; text-decoration: underline;">buat album terlebih dahulu</a>.
                                </div>
                            @endif
                        </div>

                        <!-- Tips -->
                        <div class="tips-card">
                            <h6>
                                <i class="bi bi-lightbulb-fill text-warning"></i> Tips Upload Foto yang Baik
                            </h6>
                            <ul>
                                <li>Gunakan foto dengan resolusi tinggi untuk tampilan optimal</li>
                                <li>Beri judul yang deskriptif dan menarik perhatian</li>
                                <li>Tambahkan deskripsi untuk menceritakan konteks momen</li>
                                <li>Pastikan foto ditempatkan di album yang sesuai</li>
                            </ul>
                        </div>

                        <!-- Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('foto.index') }}" class="btn-cancel">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn-upload" {{ $albums->count() == 0 ? 'disabled' : '' }}>
                                <i class="bi bi-cloud-upload"></i> Upload Foto
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
const fotoInput = document.getElementById('fotoInput');
const previewBox = document.getElementById('previewBox');
const previewPlaceholder = document.getElementById('previewPlaceholder');
const previewImage = document.getElementById('previewImage');

fotoInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewPlaceholder.style.display = 'none';
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
            previewBox.classList.add('has-image');
        }
        reader.readAsDataURL(file);
    }
});

// Character counters
const updateCounter = (inputId, counterId, max) => {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);
    if (!input || !counter) return;
    
    input.addEventListener('input', () => {
        counter.textContent = input.value.length;
    });
    counter.textContent = input.value.length;
};

updateCounter('judulFoto', 'judulCount', 150);
updateCounter('deskripsiFoto', 'deskripsiCount', 500);

// Drag & drop
const fileInputCustom = document.querySelector('.file-input-custom');
fileInputCustom.addEventListener('dragover', (e) => {
    e.preventDefault();
    fileInputCustom.style.borderColor = '#DAA520';
    fileInputCustom.style.background = 'linear-gradient(135deg, rgba(218,165,32,0.15), rgba(255,215,0,0.1))';
});
fileInputCustom.addEventListener('dragleave', (e) => {
    e.preventDefault();
    fileInputCustom.style.borderColor = 'rgba(218,165,32,0.3)';
    fileInputCustom.style.background = 'linear-gradient(135deg, rgba(218,165,32,0.08), rgba(255,215,0,0.05))';
});
fileInputCustom.addEventListener('drop', (e) => {
    e.preventDefault();
    fileInputCustom.style.borderColor = 'rgba(218,165,32,0.3)';
    fileInputCustom.style.background = 'linear-gradient(135deg, rgba(218,165,32,0.08), rgba(255,215,0,0.05))';
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fotoInput.files = files;
        fotoInput.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection