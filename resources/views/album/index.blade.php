@extends('layouts.app')

@section('title', 'Daftar Album')

@section('content')

<style>
    .album-index-container {
        animation: fadeIn 0.6s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .page-header {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        border-radius: 20px;
        padding: 2.5rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(52, 152, 219, 0.2);
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -150px;
        right: -100px;
    }
    
    .page-header::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        bottom: -100px;
        left: -50px;
    }
    
    .album-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        height: 100%;
    }
    
    .album-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(52, 152, 219, 0.25);
    }
    
    .album-cover {
        height: 240px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    }
    
    .album-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .album-card:hover .album-cover img {
        transform: scale(1.1);
    }
    
    .album-cover-empty {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        position: relative;
    }
    
    .album-cover-empty::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 10px,
            rgba(255, 255, 255, 0.05) 10px,
            rgba(255, 255, 255, 0.05) 20px
        );
    }
    
    .photo-count-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(10px);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }
    
    .album-info {
        padding: 1.5rem;
    }
    
    .album-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .album-description {
        font-size: 0.9rem;
        color: #7f8c8d;
        line-height: 1.6;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .album-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding-top: 1rem;
        border-top: 2px solid #ecf0f1;
        font-size: 0.875rem;
        color: #95a5a6;
    }
    
    .album-meta i {
        color: #3498db;
    }
    
    .album-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
    }
    
    .btn-view {
        flex: 1;
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 0.75rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        color: white;
    }
    
    .btn-delete {
        background: #e74c3c;
        color: white;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-delete:hover {
        background: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
    }
    
    .btn-create-album {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }
    
    .btn-create-album:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        color: white;
    }
    
    .empty-state {
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
    
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(52, 152, 219, 0.2);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }
    
    .stat-icon.primary {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
    }
    
    .stat-icon.success {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        color: white;
    }
</style>

<div class="album-index-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center position-relative">
            <div class="col-md-8">
                <h1 class="fw-bold mb-2">
                    <i class="bi bi-collection"></i> Album Saya
                </h1>
                <p class="mb-0 opacity-90">Kelola dan organisir koleksi foto Anda dalam album</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('album.create') }}" class="btn btn-create-album">
                    <i class="bi bi-plus-circle"></i> Buat Album Baru
                </a>
            </div>
        </div>
    </div>
    
    @if($albums->count() > 0)
        <!-- Statistics -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon primary">
                    <i class="bi bi-folder-fill"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Album</div>
                    <h3 class="fw-bold mb-0">{{ $albums->count() }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon success">
                    <i class="bi bi-images"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Foto</div>
                    <h3 class="fw-bold mb-0">{{ $albums->sum('fotos_count') }}</h3>
                </div>
            </div>
        </div>
        
        <!-- Albums Grid -->
        <div class="row g-4">
            @foreach($albums as $album)
            <div class="col-lg-4 col-md-6">
                <div class="album-card">
                    <!-- Album Cover -->
                    <div class="album-cover">
                        @if($album->fotos_count > 0 && $album->fotos->first())
                            <img src="{{ asset('storage/' . $album->fotos->first()->LokasiFile) }}" 
                                 alt="{{ $album->NamaAlbum }}">
                        @else
                            <div class="album-cover-empty">
                                <i class="bi bi-folder-open text-white" style="font-size: 5rem; opacity: 0.4; position: relative; z-index: 1;"></i>
                            </div>
                        @endif
                        
                        <div class="photo-count-badge">
                            <i class="bi bi-images"></i>
                            <span>{{ $album->fotos_count }}</span>
                        </div>
                    </div>
                    
                    <!-- Album Info -->
                    <div class="album-info">
                        <h5 class="album-title">{{ $album->NamaAlbum }}</h5>
                        
                        @if($album->Deskripsi)
                            <p class="album-description">{{ $album->Deskripsi }}</p>
                        @else
                            <p class="album-description fst-italic">
                                Belum ada deskripsi untuk album ini
                            </p>
                        @endif
                        
                        <div class="album-meta">
                            <span>
                                <i class="bi bi-calendar3"></i>
                                {{ $album->TanggalDibuat->format('d M Y') }}
                            </span>
                        </div>
                        
                        <div class="album-actions">
                            <a href="{{ route('album.show', $album->AlbumID) }}" class="btn-view">
                                <i class="bi bi-eye-fill"></i> Lihat Album
                            </a>
                            <form action="{{ route('album.destroy', $album->AlbumID) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin hapus album dan semua fotonya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-folder-open" style="font-size: 4rem; color: #3498db;"></i>
            </div>
            <h3 class="fw-bold mb-3">Belum Ada Album</h3>
            <p class="text-muted mb-4">Buat album pertama Anda untuk mulai mengorganisir foto-foto</p>
            <a href="{{ route('album.create') }}" class="btn btn-create-album">
                <i class="bi bi-plus-circle"></i> Buat Album Pertama
            </a>
        </div>
    @endif
</div>

@endsection