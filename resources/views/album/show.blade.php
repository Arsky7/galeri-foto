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

    .btn-back {
        background: rgba(218,165,32,0.15);
        color: #FFD700;
        border: 1px solid rgba(218,165,32,0.3);
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-back:hover {
        background: rgba(218,165,32,0.25);
        transform: translateX(-5px);
        box-shadow: 0 6px 20px rgba(218,165,32,0.2);
    }

    .album-header-card {
        background: linear-gradient(135deg, rgba(15,15,15,0.95) 0%, rgba(25,25,25,0.9) 100%);
        border-radius: 24px;
        padding: 2.8rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 2.5rem;
        border: 1px solid rgba(218,165,32,0.25);
        box-shadow: 0 15px 50px rgba(0,0,0,0.6);
    }

    .album-title {
        font-size: 2.3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.7rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .album-description {
        color: rgba(218,165,32,0.85);
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .privacy-badge {
        display: inline-block;
        padding: 0.3rem 1rem;
        background: rgba(220,53,69,0.15);
        color: #ff6b6b;
        border: 1px solid rgba(220,53,69,0.3);
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.95rem;
        margin-top: 0.8rem;
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
        padding: 1.1rem;
        background: rgba(218,165,32,0.08);
        border-radius: 12px;
        border: 1px solid rgba(218,165,32,0.2);
    }

    .info-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #DAA520, #FFD700);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-size: 1.5rem;
        font-weight: 800;
    }

    .info-text .text-muted {
        color: #aaa;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .info-text .fw-bold {
        color: #FFD700;
        font-size: 1.2rem;
        font-weight: 700;
    }

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
        transition: all 0.4s ease;
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

    .empty-album {
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
        background: rgba(218,165,32,0.08);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
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

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.2rem;
    }

    .section-title {
        font-size: 1.6rem;
        font-weight: 800;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .photo-count-badge {
        background: rgba(218,165,32,0.2);
        color: #FFD700;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: 1px solid rgba(218,165,32,0.3);
    }

    @media (max-width: 768px) {
        .foto-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 18px; }
        .foto-image-wrapper { height: 220px; }
        .album-title { font-size: 1.8rem; }
        .album-header-card { padding: 2rem 1.5rem; }
    }
</style>

<div class="album-show-container">
    <a href="{{ route('album.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Album
    </a>

    <div class="album-header-card">
        <h1 class="album-title">
            <i class="bi bi-folder-open"></i> {{ $album->NamaAlbum }}
        </h1>

        @if($album->Deskripsi)
            <p class="album-description">{{ $album->Deskripsi }}</p>
        @endif

        <!-- Tampilkan badge jika album privat -->
        @if(!$album->is_public)
            <div class="privacy-badge">
                <i class="bi bi-lock-fill"></i> Album Privat — Hanya Anda yang bisa melihat
            </div>
        @endif

        <div class="album-info-grid">
            <div class="info-item">
                <div class="info-icon">
                    <i class="bi bi-calendar3"></i>
                </div>
                <div class="info-text">
                    <div class="text-muted">Dibuat Pada</div>
                    <div class="fw-bold">{{ $album->TanggalDibuat->format('d M Y') }}</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="bi bi-images"></i>
                </div>
                <div class="info-text">
                    <div class="text-muted">Total Foto</div>
                    <div class="fw-bold">{{ $album->fotos->count() }} Foto</div>
                </div>
            </div>
        </div>
    </div>

    @if($album->fotos->count() > 0)
        <div class="section-header">
            <h3 class="section-title">
                <i class="bi bi-images"></i> Koleksi Foto
            </h3>
            <span class="photo-count-badge">
                <i class="bi bi-collection"></i> {{ $album->fotos->count() }} Foto
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
                                    <i class="bi bi-heart-fill"></i> {{ $foto->likes->count() }}
                                </span>
                                <span>
                                    <i class="bi bi-chat-fill"></i> {{ $foto->komentars->count() }}
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
                <i class="bi bi-image"></i>
            </div>
            <h3 class="empty-title">Album Masih Kosong</h3>
            <p class="empty-text">Belum ada foto di album ini. Mulai upload foto pertama Anda!</p>
            <a href="{{ route('foto.create') }}" class="btn-upload">
                <i class="bi bi-cloud-upload"></i> Upload Foto Sekarang
            </a>
        </div>
    @endif
</div>
@endsection