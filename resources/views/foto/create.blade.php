@extends('layouts.app')

@section('title', 'Upload Foto')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        
        <div class="mb-4">
            <h2 class="fw-bold">Upload Foto Baru</h2>
            <p class="text-muted">Bagikan momen indahmu dengan dunia</p>
        </div>
        
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Preview Foto -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="bi bi-image"></i> Preview Foto
                        </label>
                        <div id="imagePreview" class="border rounded p-3 text-center" style="min-height: 300px; background-color: #f8f9fa;">
                            <div id="previewPlaceholder">
                                <i class="bi bi-cloud-upload text-muted" style="font-size: 4rem;"></i>
                                <p class="text-muted mt-2">Pilih foto untuk melihat preview</p>
                            </div>
                            <img id="previewImage" src="" alt="Preview" class="img-fluid d-none" style="max-height: 400px;">
                        </div>
                    </div>
                    
                    <!-- File Upload -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-upload"></i> Pilih Foto <span class="text-danger">*</span>
                        </label>
                        <input type="file" 
                               name="foto" 
                               id="fotoInput"
                               class="form-control @error('foto') is-invalid @enderror" 
                               accept="image/*"
                               required>
                        <small class="text-muted">Format: JPG, PNG, GIF (Max. 5MB)</small>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Judul Foto -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-type"></i> Judul Foto <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="JudulFoto" 
                               class="form-control @error('JudulFoto') is-invalid @enderror" 
                               value="{{ old('JudulFoto') }}"
                               placeholder="Contoh: Sunset di Pantai"
                               required>
                        @error('JudulFoto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-card-text"></i> Deskripsi (Opsional)
                        </label>
                        <textarea name="DeskripsiFoto" 
                                  class="form-control @error('DeskripsiFoto') is-invalid @enderror" 
                                  rows="3"
                                  placeholder="Ceritakan tentang foto ini...">{{ old('DeskripsiFoto') }}</textarea>
                        @error('DeskripsiFoto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Pilih Album -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="bi bi-folder"></i> Pilih Album <span class="text-danger">*</span>
                        </label>
                        
                        @if($albums->count() > 0)
                        <select name="AlbumID" class="form-select @error('AlbumID') is-invalid @enderror" required>
                            <option value="">-- Pilih Album --</option>
                            @foreach($albums as $album)
                            <option value="{{ $album->AlbumID }}" {{ old('AlbumID') == $album->AlbumID ? 'selected' : '' }}>
                                {{ $album->NamaAlbum }}
                            </option>
                            @endforeach
                        </select>
                        @error('AlbumID')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i>
                            Anda belum memiliki album. 
                            <a href="{{ route('album.create') }}" class="alert-link fw-bold">Buat album dulu</a>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('foto.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary" {{ $albums->count() == 0 ? 'disabled' : '' }}>
                            <i class="bi bi-upload"></i> Upload Foto
                        </button>
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
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewPlaceholder').classList.add('d-none');
            const previewImage = document.getElementById('previewImage');
            previewImage.src = e.target.result;
            previewImage.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection