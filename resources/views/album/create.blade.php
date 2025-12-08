@extends('layouts.app')

@section('title', 'Buat Album')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        
        <div class="mb-4">
            <h2 class="fw-bold">Buat Album Baru</h2>
            <p class="text-muted">Atur foto Anda ke dalam album</p>
        </div>
        
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('album.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Album -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-folder"></i> Nama Album <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="NamaAlbum" 
                               class="form-control @error('NamaAlbum') is-invalid @enderror" 
                               value="{{ old('NamaAlbum') }}"
                               placeholder="Contoh: Liburan 2024"
                               required>
                        @error('NamaAlbum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="bi bi-card-text"></i> Deskripsi (Opsional)
                        </label>
                        <textarea name="Deskripsi" 
                                  class="form-control @error('Deskripsi') is-invalid @enderror" 
                                  rows="3"
                                  placeholder="Ceritakan tentang album ini...">{{ old('Deskripsi') }}</textarea>
                        @error('Deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('album.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Buat Album
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection