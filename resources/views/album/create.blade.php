@extends('layouts.app')

@section('title', 'Buat Album')

@section('content')
<style>
    .create-album-container {
        animation: slideInUp 0.6s ease;
    }
    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .album-card {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        border: 1px solid rgba(218,165,32,0.2);
        border-radius: 22px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.5);
        overflow: hidden;
        position: relative;
    }

    .album-header {
        background: rgba(218,165,32,0.1);
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid rgba(218,165,32,0.2);
    }

    .album-title {
        font-size: 2.1rem;
        font-weight: 800;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .album-subtitle {
        color: rgba(218,165,32,0.85);
        font-size: 1.05rem;
    }

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
        padding: 0.15rem 0.55rem;
        border-radius: 20px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .form-control-custom,
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

    .char-counter {
        color: #aaa;
        text-align: right;
        margin-top: 0.4rem;
        font-size: 0.9rem;
    }

    /* Public/Private Toggle */
    .privacy-toggle {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 1rem 0;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #666;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background: linear-gradient(135deg, #DAA520, #FFD700);
    }

    input:checked + .slider:before {
        transform: translateX(30px);
    }

    .privacy-help {
        background: rgba(218,165,32,0.08);
        border: 1px solid rgba(218,165,32,0.2);
        border-radius: 12px;
        padding: 1.2rem;
        margin: 1.5rem 0;
    }

    .privacy-help h6 {
        color: #FFD700;
        margin-bottom: 0.7rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .privacy-help ul {
        padding-left: 1.4rem;
        margin: 0;
        color: #ccc;
        font-size: 0.95rem;
    }

    .privacy-help li {
        margin-bottom: 0.4rem;
        line-height: 1.6;
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
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-cancel:hover {
        background: rgba(218,165,32,0.25);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(218,165,32,0.2);
    }

    .btn-submit {
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
    }
    .btn-submit:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(218,165,32,0.6);
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
    }

    /* Responsif */
    @media (max-width: 768px) {
        .btn-cancel, .btn-submit {
            flex: none;
            width: 100%;
        }
    }
</style>

<div class="create-album-container">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="album-card">
                <div class="album-header">
                    <h2 class="album-title">Buat Album Baru</h2>
                    <p class="album-subtitle">Organisir foto-foto Anda dalam album yang terstruktur</p>
                </div>

                <div class="form-section">
                    <form action="{{ route('album.store') }}" method="POST" id="albumForm">
                        @csrf

                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-folder"></i> Nama Album
                                <span class="required-badge">Wajib</span>
                            </label>
                            <input type="text" 
                                   name="NamaAlbum" 
                                   id="namaAlbum"
                                   class="form-control-custom @error('NamaAlbum') is-invalid @enderror"
                                   value="{{ old('NamaAlbum') }}"
                                   placeholder="Contoh: Liburan Bali, Wisuda..."
                                   maxlength="100"
                                   required>
                            <div class="char-counter">
                                <span id="charCount">0</span>/100 karakter
                            </div>
                            @error('NamaAlbum')
                                <div class="text-danger mt-2" style="font-size: 0.9rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-card-text"></i> Deskripsi Album
                                <span class="badge bg-secondary" style="font-size: 0.75rem; padding: 0.25em 0.6em;">Opsional</span>
                            </label>
                            <textarea name="Deskripsi" 
                                      id="deskripsi"
                                      class="form-control-custom @error('Deskripsi') is-invalid @enderror"
                                      placeholder="Ceritakan tentang album ini...">{{ old('Deskripsi') }}</textarea>
                            <div class="char-counter">
                                <span id="descCharCount">0</span>/500 karakter
                            </div>
                            @error('Deskripsi')
                                <div class="text-danger mt-2" style="font-size: 0.9rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Privacy Toggle (SUDAH DIPERBAIKI) -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-shield-lock"></i> Privasi Album
                            </label>
                            <!-- Hidden input untuk nilai default "0" -->
                            <input type="hidden" name="is_public" value="0">
                            <div class="privacy-toggle">
                                <label class="switch">
                                    <input type="checkbox" name="is_public" value="1" {{ old('is_public') ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                                <div id="privacy-label-text">
                                    @if(old('is_public'))
                                        <strong class="text-success">Publik</strong> — bisa dilihat semua orang
                                    @else
                                        <strong class="text-warning">Privat</strong> — hanya Anda yang bisa melihat
                                    @endif
                                </div>
                            </div>
                            <div class="privacy-help">
                                <h6>
                                    <i class="bi bi-lightbulb text-warning"></i> Tentang Privasi
                                </h6>
                                <ul>
                                    <li><strong>Publik</strong>: Album muncul di profil Anda dan bisa dilihat siapa saja</li>
                                    <li><strong>Privat</strong>: Hanya Anda yang bisa melihat album ini</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('album.index') }}" class="btn-cancel">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-check-circle"></i> Buat Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Character counters
const namaAlbum = document.getElementById('namaAlbum');
const charCount = document.getElementById('charCount');
const deskripsi = document.getElementById('deskripsi');
const descCharCount = document.getElementById('descCharCount');

if (namaAlbum) {
    namaAlbum.addEventListener('input', () => {
        charCount.textContent = namaAlbum.value.length;
    });
    charCount.textContent = namaAlbum.value.length;
}

if (deskripsi) {
    deskripsi.addEventListener('input', () => {
        descCharCount.textContent = deskripsi.value.length;
    });
    descCharCount.textContent = deskripsi.value.length;
}

// Privacy toggle handler
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('input[name="is_public"]');
    const label = document.getElementById('privacy-label-text');
    
    if (!toggle || !label) return;

    function updateLabel() {
        if (toggle.checked) {
            label.innerHTML = '<strong class="text-success">Publik</strong> — bisa dilihat semua orang';
        } else {
            label.innerHTML = '<strong class="text-warning">Privat</strong> — hanya Anda yang bisa melihat';
        }
    }

    // Set initial state
    updateLabel();

    // Update on toggle change
    toggle.addEventListener('change', updateLabel);
});
</script>
@endpush
@endsection