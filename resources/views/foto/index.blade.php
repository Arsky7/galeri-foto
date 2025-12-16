@extends('layouts.app')

@section('title', 'Galeri Foto')

@section('content')
<style>
    /* ========== KEYFRAMES ========== */
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }

    /* ========== HEADER ========== */
    .galeri-header {
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

    .galeri-header::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(218,165,32,0.1) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    .galeri-title {
        font-size: 2.4rem;
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

    .galeri-subtitle {
        color: rgba(218,165,32,0.85);
        font-size: 1.15rem;
        font-weight: 400;
        max-width: 700px;
    }

    /* ========== FOTO GRID ========== */
    .foto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 28px;
    }

    .foto-card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        background: rgba(20,20,20,0.9);
        border: 1px solid rgba(218,165,32,0.15);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeSlideUp 0.6s ease;
        box-shadow: 0 8px 25px rgba(0,0,0,0.5);
    }

    .foto-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 50px rgba(0,0,0,0.7),
                    0 0 25px rgba(218,165,32,0.2);
        border-color: rgba(218,165,32,0.3);
    }

    .foto-image-wrapper {
        height: 300px;
        overflow: hidden;
        position: relative;
    }

    .foto-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .foto-card:hover img {
        transform: scale(1.1) rotate(1deg);
    }

    .foto-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, transparent 100%);
        padding: 1.5rem;
        color: white;
        opacity: 0;
        transform: translateY(25px);
        transition: all 0.4s ease;
    }

    .foto-card:hover .foto-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .foto-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
        color: #FFD700;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .foto-author {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        color: #aaa;
    }

    .author-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #DAA520, #FFD700);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #000;
        font-size: 0.9rem;
        border: 2px solid rgba(255,255,255,0.3);
    }

    .foto-stats {
        display: flex;
        gap: 1.6rem;
        font-size: 0.95rem;
        color: #ccc;
    }

    .foto-stats i {
        color: #DAA520;
        margin-right: 0.4rem;
    }

    /* ========== EMPTY STATE ========== */
    .empty-galeri {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        border-radius: 24px;
        padding: 4rem 2rem;
        text-align: center;
        border: 1px solid rgba(218,165,32,0.2);
        box-shadow: 0 15px 40px rgba(0,0,0,0.6);
    }

    .empty-icon {
        width: 150px;
        height: 150px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, rgba(218,165,32,0.15) 0%, rgba(255,215,0,0.08) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: float 3s ease-in-out infinite;
        border: 2px solid rgba(218,165,32,0.3);
    }
    .empty-icon i {
        font-size: 5.2rem;
        color: #DAA520;
    }

    .empty-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-text {
        color: #aaa;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 2.5rem;
        line-height: 1.7;
    }

    .btn-upload {
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #000;
        border: none;
        padding: 1rem 2.8rem;
        border-radius: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(218,165,32,0.4);
        display: inline-flex;
        align-items: center;
        gap: 0.7rem;
        font-size: 1.1rem;
    }
    .btn-upload:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(218,165,32,0.6);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .foto-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 18px; }
        .foto-image-wrapper { height: 220px; }
        .galeri-title { font-size: 1.8rem; }
        .galeri-header { padding: 2rem 1.5rem; }
    }

    @media (max-width: 576px) {
        .foto-stats { gap: 1rem; font-size: 0.85rem; }
        .author-avatar { width: 30px; height: 30px; font-size: 0.8rem; }
    }
</style>

<div class="galeri-container">
    <!-- Header -->
    <div class="galeri-header">
        <h1 class="galeri-title">
            <i class="bi bi-images"></i> Galeri Foto
        </h1>
        <p class="galeri-subtitle">
            Jelajahi dan temukan foto-foto menakjubkan dari seluruh pengguna
        </p>
    </div>
    
    <!-- Foto Grid -->
    <div class="foto-grid">
        @foreach($fotos as $foto)
        <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none">
            <div class="foto-card">
                <div class="foto-image-wrapper">
                    <img src="{{ asset('storage/' . $foto->LokasiFile) }}" 
                         alt="{{ $foto->JudulFoto }}"
                         loading="lazy">
                    
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
                                {{ $foto->likes_count ?? 0 }}
                            </span>
                            <span>
                                <i class="bi bi-chat-fill"></i>
                                {{ $foto->komentars_count ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($fotos->count() == 0)
    <div class="empty-galeri">
        <div class="empty-icon">
            <i class="bi bi-camera"></i>
        </div>
        <h3 class="empty-title">Galeri Masih Kosong</h3>
        <p class="empty-text">
            Belum ada foto yang diupload. Jadilah yang pertama berbagi momen indah!
        </p>
        <a href="{{ route('foto.create') }}" class="btn-upload">
            <i class="bi bi-cloud-upload"></i>
            Upload Foto Pertama
        </a>
    </div>
    @endif
</div>

@endsection@extends('layouts.app')

@section('title', 'Galeri Foto')

@section('content')
<style>
    /* ========== KEYFRAMES ========== */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }

    /* ========== HEADER ========== */
    .galeri-header {
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

    .galeri-header::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(218,165,32,0.1) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    .galeri-title {
        font-size: 2.4rem;
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

    .galeri-subtitle {
        color: rgba(218,165,32,0.85);
        font-size: 1.15rem;
        font-weight: 400;
        max-width: 700px;
    }

    /* ========== FOTO GRID ========== */
    .foto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 28px;
    }

    .foto-card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        background: rgba(20,20,20,0.9);
        border: 1px solid rgba(218,165,32,0.15);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeSlideUp 0.6s ease;
        box-shadow: 0 8px 25px rgba(0,0,0,0.5);
    }

    .foto-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 50px rgba(0,0,0,0.7),
                    0 0 25px rgba(218,165,32,0.2);
        border-color: rgba(218,165,32,0.3);
    }

    .foto-image-wrapper {
        height: 300px;
        overflow: hidden;
        position: relative;
    }

    .foto-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .foto-card:hover img {
        transform: scale(1.1) rotate(1deg);
    }

    .foto-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, transparent 100%);
        padding: 1.5rem;
        color: white;
        opacity: 0;
        transform: translateY(25px);
        transition: all 0.4s ease;
    }

    .foto-card:hover .foto-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .foto-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
        color: #FFD700;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .foto-author {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        color: #aaa;
    }

    .author-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #DAA520, #FFD700);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #000;
        font-size: 0.9rem;
        border: 2px solid rgba(255,255,255,0.3);
    }

    .foto-stats {
        display: flex;
        gap: 1.6rem;
        font-size: 0.95rem;
        color: #ccc;
    }

    .foto-stats i {
        color: #DAA520;
        margin-right: 0.4rem;
    }

    /* ========== EMPTY STATE ========== */
    .empty-galeri {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        border-radius: 24px;
        padding: 4rem 2rem;
        text-align: center;
        border: 1px solid rgba(218,165,32,0.2);
        box-shadow: 0 15px 40px rgba(0,0,0,0.6);
    }

    .empty-icon {
        width: 150px;
        height: 150px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, rgba(218,165,32,0.15) 0%, rgba(255,215,0,0.08) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: float 3s ease-in-out infinite;
        border: 2px solid rgba(218,165,32,0.3);
    }
    .empty-icon i {
        font-size: 5.2rem;
        color: #DAA520;
    }

    .empty-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-text {
        color: #aaa;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 2.5rem;
        line-height: 1.7;
    }

    .btn-upload {
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #000;
        border: none;
        padding: 1rem 2.8rem;
        border-radius: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(218,165,32,0.4);
        display: inline-flex;
        align-items: center;
        gap: 0.7rem;
        font-size: 1.1rem;
    }
    .btn-upload:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(218,165,32,0.6);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .foto-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 18px; }
        .foto-image-wrapper { height: 220px; }
        .galeri-title { font-size: 1.8rem; }
        .galeri-header { padding: 2rem 1.5rem; }
    }

    @media (max-width: 576px) {
        .foto-stats { gap: 1rem; font-size: 0.85rem; }
        .author-avatar { width: 30px; height: 30px; font-size: 0.8rem; }
    }
</style>

<div class="galeri-container">
    <!-- Header -->
    <div class="galeri-header">
        <h1 class="galeri-title">
            <i class="bi bi-images"></i> Galeri Foto
        </h1>
        <p class="galeri-subtitle">
            Jelajahi dan temukan foto-foto menakjubkan dari seluruh pengguna
        </p>
    </div>
    
    <!-- Foto Grid -->
    <div class="foto-grid">
        @forelse($fotos as $foto)
        <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none">
            <div class="foto-card">
                <div class="foto-image-wrapper">
                    <img src="{{ asset('storage/' . $foto->LokasiFile) }}" 
                         alt="{{ $foto->JudulFoto }}"
                         loading="lazy">
                    
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
                                {{ $foto->likes_count ?? 0 }}
                            </span>
                            <span>
                                <i class="bi bi-chat-fill"></i>
                                {{ $foto->komentars_count ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="empty-galeri">
            <div class="empty-icon">
                <i class="bi bi-camera"></i>
            </div>
            <h3 class="empty-title">Galeri Masih Kosong</h3>
            <p class="empty-text">
                Belum ada foto yang diupload. Jadilah yang pertama berbagi momen indah!
            </p>
            <a href="{{ route('foto.create') }}" class="btn-upload">
                <i class="bi bi-cloud-upload"></i>
                Upload Foto Pertama
            </a>
        </div>
        @endforelse
    </div>
</div>

@endsection