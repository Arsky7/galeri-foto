@extends('layouts.app')

@section('title', 'Galeri Foto')

@section('content')

<style>
    .galeri-container {
        animation: fadeIn 0.6s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .galeri-header {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        border-radius: 20px;
        padding: 2.5rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(52, 152, 219, 0.2);
    }
    
    .galeri-header::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        top: -200px;
        right: -100px;
    }
    
    .galeri-header::after {
        content: '';
        position: absolute;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        bottom: -125px;
        left: -75px;
    }
    
    .foto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    
    .foto-card {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: scaleIn 0.5s ease;
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .foto-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 16px 50px rgba(52, 152, 219, 0.3);
    }
    
    .foto-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 320px;
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    }
    
    .foto-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .foto-card:hover img {
        transform: scale(1.15) rotate(2deg);
    }
    
    .foto-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.95), transparent);
        padding: 2rem 1.5rem 1.5rem;
        color: white;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.4s ease;
    }
    
    .foto-card:hover .foto-overlay {
        opacity: 1;
        transform: translateY(0);
    }
    
    .foto-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .foto-author {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }
    
    .author-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #3498db, #2c3e50);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        border: 2px solid white;
    }
    
    .foto-stats {
        display: flex;
        gap: 1.5rem;
        font-size: 0.95rem;
    }
    
    .foto-stats span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .foto-stats span:hover {
        transform: scale(1.1);
    }
    
    .empty-galeri {
        background: white;
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    
    .empty-icon {
        width: 140px;
        height: 140px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, #ebf4f5 0%, #b5c6e0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .btn-upload {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.05rem;
    }
    
    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        color: white;
    }
    
    .pagination {
        margin-top: 3rem;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .pagination .page-link {
        border: 2px solid #e0e6ed;
        border-radius: 10px;
        padding: 0.75rem 1.25rem;
        color: #2c3e50;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .pagination .page-link:hover {
        background: #3498db;
        color: white;
        border-color: #3498db;
        transform: translateY(-2px);
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        border-color: #3498db;
    }
</style>

<div class="galeri-container">
    <!-- Header -->
    <div class="galeri-header position-relative">
        <h1 class="fw-bold mb-2">
            <i class="bi bi-images"></i> Galeri Foto
        </h1>
        <p class="mb-0 opacity-90" style="font-size: 1.1rem;">
            Jelajahi dan temukan foto-foto menakjubkan dari seluruh pengguna
        </p>
    </div>
    
    @if($fotos->count() > 0)
        <div class="foto-grid">
            @foreach($fotos as $foto)
            <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none">
                <div class="foto-card">
                    <div class="foto-image-wrapper">
                        <img src="{{ asset('storage/' . $foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}">
                        
                        <div class="foto-overlay">
                            <h6 class="foto-title">{{ $foto->JudulFoto }}</h6>
                            
                            <div class="foto-author">
                                <div class="author-avatar">
                                    {{ substr($foto->user->NamaLengkap, 0, 1) }}
                                </div>
                                <span>{{ $foto->user->Username }}</span>
                            </div>
                            
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

        <!-- Pagination -->
        <div class="pagination">
            {{ $fotos->links() }}
        </div>
    @else
        <div class="empty-galeri">
            <div class="empty-icon">
                <i class="bi bi-camera" style="font-size: 5rem; color: #3498db;"></i>
            </div>
            <h3 class="fw-bold mb-3">Galeri Masih Kosong</h3>
            <p class="text-muted mb-4" style="font-size: 1.1rem;">
                Belum ada foto yang diupload. Jadilah yang pertama berbagi momen indah!
            </p>
            <a href="{{ route('foto.create') }}" class="btn-upload">
                <i class="bi bi-cloud-upload"></i>
                Upload Foto Pertama
            </a>
        </div>
    @endif
</div>

@endsection