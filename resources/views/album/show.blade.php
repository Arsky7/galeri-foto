@extends('layouts.app')

@section('title', $album->NamaAlbum)

@section('content')

<style>
    .album-show-container {
        animation: fadeIn 0.6s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .album-header-card {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        border-radius: 20px;
        padding: 2.5rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(52, 152, 219, 0.2);
    }
    
    .album-header-card::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -150px;
        right: -100px;
    }
    
    .btn-back {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .btn-back:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateX(-5px);
    }
    
    .album-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .info-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .foto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    
    .foto-card {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .foto-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(52, 152, 219, 0.25);
    }
    
    .foto-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 280px;
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    }
    
    .foto-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .foto-card:hover img {
        transform: scale(1.1);
    }
    
    .foto-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
        padding: 1.5rem;
        color: white;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }
    
    .foto-card:hover .foto-overlay {
        opacity: 1;
        transform: translateY(0);
    }
    
    .foto-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .foto-stats {
        display: flex;
        gap: 1rem;
        font-size: 0.9rem;
    }
    
    .foto-stats span {
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }
    
    .empty-album {
        background: white;
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    
    .empty-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, #ebf4f5 0%, #b5c6e0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-upload {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        color: white;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .photo-count-badge {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>

<div class="album-show-container">
    <!-- Back Button -->
    <a href="{{ route('album.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
        Kembali ke Daftar Album
    </a>
    
    <!-- Album Header -->
    <div class="album-header-card position-relative">
        <h1 class="fw-bold mb-2">
            <i class="bi bi-folder-open"></i> {{ $album->NamaAlbum }}
        </h1>
        
        @if($album->Deskripsi)
            <p class="mb-0 opacity-90" style="font-size: 1.1rem;">{{ $album->Deskripsi }}</p>
        @endif
        
        <div class="album-info-grid">
            <div class="info-item">
                <div class="info-icon">
                    <i class="bi bi-calendar3"></i>
                </div>
                <div>
                    <div class="small opacity-75">Dibuat Pada</div>
                    <div class="fw-bold">{{ $album->TanggalDibuat->format('d M Y') }}</div>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="bi bi-images"></i>
                </div>
                <div>
                    <div class="small opacity-75">Total Foto</div>
                    <div class="fw-bold">{{ $album->fotos->count() }} Foto</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Photos Section -->
    @if($album->fotos->count() > 0)
        <div class="section-header">
            <h3 class="fw-bold mb-0">
                <i class="bi bi-images"></i> Koleksi Foto
            </h3>
            <span class="photo-count-badge">
                <i class="bi bi-collection"></i>
                {{ $album->fotos->count() }} Foto
            </span>
        </div>
        
        <div class="foto-grid">
            @foreach($album->fotos as $foto)
            <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none">
                <div class="foto-card">
                    <div class="foto-image-wrapper">
                        <img src="{{ asset('storage/' . $foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}">
                        
                        <div class="foto-overlay">
                            <h6 class="foto-title">{{ $foto->JudulFoto }}</h6>
                            <div class="foto-stats">
                                <span>
                                    <i class="bi bi-heart-fill"></i>
                                    {{ $foto->likes->count() }}
                                </span>
                                <span>
                                    <i class="bi bi-chat-fill"></i>
                                    {{ $foto->komentars->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @else
        <div class="empty-album">
            <div class="empty-icon">
                <i class="bi bi-image" style="font-size: 4rem; color: #3498db;"></i>
            </div>
            <h3 class="fw-bold mb-3">Album Masih Kosong</h3>
            <p class="text-muted mb-4">Belum ada foto di album ini. Mulai upload foto pertama Anda!</p>
            <a href="{{ route('foto.create') }}" class="btn-upload">
                <i class="bi bi-cloud-upload"></i>
                Upload Foto Sekarang
            </a>
        </div>
    @endif
</div>

@endsection