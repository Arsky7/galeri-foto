@extends('layouts.app')

@section('title', 'Daftar Album')

@section('content')
<style>
    .album-index-container {
        animation: fadeIn 0.6s ease;
    }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

    .page-header {
        background: linear-gradient(135deg, rgba(15,15,15,0.95) 0%, rgba(25,25,25,0.9) 100%);
        border-radius: 24px;
        padding: 2.8rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 2.5rem;
        border: 1px solid rgba(218,165,32,0.25);
        box-shadow: 0 15px 50px rgba(0,0,0,0.6);
    }

    .page-title {
        font-size: 2.4rem;
        font-weight: 800;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.75rem;
    }

    .page-subtitle {
        color: rgba(218,165,32,0.85);
        font-size: 1.1rem;
    }

    .btn-create-album {
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #000;
        border: none;
        padding: 0.9rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 8px 25px rgba(218,165,32,0.4);
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
    }
    .btn-create-album:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(218,165,32,0.6);
    }

    .album-card {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.4s ease;
        border: 1px solid rgba(218,165,32,0.2);
        box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    }

    .album-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 40px rgba(0,0,0,0.6),
                    0 0 20px rgba(218,165,32,0.15);
        border-color: rgba(218,165,32,0.3);
    }

    .album-cover {
        height: 240px;
        position: relative;
        overflow: hidden;
        background: #0f0f0f;
    }

    .album-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .album-card:hover .album-cover img {
        transform: scale(1.12);
    }

    .album-cover-empty {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: rgba(218,165,32,0.3);
    }
    .album-cover-empty i {
        font-size: 5rem;
        opacity: 0.4;
    }

    .photo-count-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0,0,0,0.7);
        color: #FFD700;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.4);
    }

    .album-info {
        padding: 1.6rem;
    }

    .album-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: #FFD700;
        margin-bottom: 0.8rem;
        line-height: 1.4;
    }

    .album-description {
        color: #ccc;
        line-height: 1.7;
        margin-bottom: 1.2rem;
        font-size: 0.95rem;
    }
    .album-description.fst-italic {
        color: #888;
    }

    .privacy-badge {
        display: inline-block;
        padding: 0.25rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    .privacy-badge.public {
        background: rgba(40,167,69,0.15);
        color: #51cf66;
        border: 1px solid rgba(40,167,69,0.3);
    }
    .privacy-badge.private {
        background: rgba(220,53,69,0.15);
        color: #ff6b6b;
        border: 1px solid rgba(220,53,69,0.3);
    }

    .album-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(218,165,32,0.1);
        font-size: 0.9rem;
        color: #aaa;
    }

    .btn-view {
        flex: 1;
        background: linear-gradient(135deg, rgba(218,165,32,0.15) 0%, rgba(255,215,0,0.1) 100%);
        color: #FFD700;
        border: 1px solid rgba(218,165,32,0.3);
        padding: 0.8rem;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-view:hover {
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #000;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(218,165,32,0.3);
    }

    .btn-delete {
        background: rgba(220,53,69,0.2);
        color: #ff6b6b;
        border: 1px solid rgba(220,53,69,0.3);
        padding: 0.8rem 1rem;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .btn-delete:hover {
        background: #c0392b;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(220,53,69,0.4);
    }

    .empty-state {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        border-radius: 24px;
        padding: 4rem 2rem;
        text-align: center;
        border: 1px solid rgba(218,165,32,0.2);
        box-shadow: 0 15px 40px rgba(0,0,0,0.5);
    }

    .empty-icon {
        width: 130px;
        height: 130px;
        margin: 0 auto 2rem;
        background: rgba(218,165,32,0.08);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(218,165,32,0.3);
    }
    .empty-icon i {
        font-size: 4.5rem;
        color: #DAA520;
    }

    .empty-title {
        font-size: 1.6rem;
        font-weight: 800;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-text {
        color: #aaa;
        margin-bottom: 2rem;
        font-size: 1.05rem;
        line-height: 1.7;
    }

    /* Stats */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.2rem;
        margin-bottom: 2.2rem;
    }

    .stat-card {
        background: rgba(218,165,32,0.08);
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid rgba(218,165,32,0.2);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: rgba(218,165,32,0.35);
        background: rgba(218,165,32,0.12);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #DAA520, #FFD700);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-size: 1.75rem;
        font-weight: 800;
    }

    .stat-text .text-muted {
        color: #aaa;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .stat-text h3 {
        font-weight: 800;
        color: #FFD700;
        margin: 0;
        font-size: 1.5rem;
    }
</style>

<div class="album-index-container">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="bi bi-collection"></i> Album Saya
                </h1>
                <p class="page-subtitle">Kelola dan organisir koleksi foto Anda</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('album.create') }}" class="btn btn-create-album">
                    <i class="bi bi-plus-circle"></i> Buat Album
                </a>
            </div>
        </div>
    </div>

    @if($albums->count() > 0)
        <!-- Statistics -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-folder"></i>
                </div>
                <div class="stat-text">
                    <div class="text-muted">Total Album</div>
                    <h3>{{ $albums->count() }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-image"></i>
                </div>
                <div class="stat-text">
                    <div class="text-muted">Total Foto</div>
                    <h3>{{ $albums->sum('fotos_count') }}</h3>
                </div>
            </div>
        </div>

        <!-- Albums Grid -->
        <div class="row g-4">
            @foreach($albums as $album)
            <div class="col-lg-4 col-md-6">
                <div class="album-card">
                    <div class="album-cover">
                        @if($album->fotos_count > 0 && $album->fotos->first())
                            <img src="{{ asset('storage/' . $album->fotos->first()->LokasiFile) }}" alt="{{ $album->NamaAlbum }}">
                        @else
                            <div class="album-cover-empty">
                                <i class="bi bi-folder-open"></i>
                            </div>
                        @endif
                        <div class="photo-count-badge">
                            <i class="bi bi-images"></i> {{ $album->fotos_count }}
                        </div>
                    </div>

                    <div class="album-info">
                        <span class="privacy-badge {{ $album->is_public ? 'public' : 'private' }}">
                            @if($album->is_public)
                                <i class="bi bi-globe"></i> Publik
                            @else
                                <i class="bi bi-lock-fill"></i> Privat
                            @endif
                        </span>

                        <h5 class="album-title">{{ $album->NamaAlbum }}</h5>

                        @if($album->Deskripsi)
                            <p class="album-description">{{ $album->Deskripsi }}</p>
                        @else
                            <p class="album-description fst-italic">Tidak ada deskripsi</p>
                        @endif

                        <div class="album-meta">
                            <i class="bi bi-calendar3"></i>
                            {{ $album->TanggalDibuat->format('d M Y') }}
                        </div>

                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('album.show', $album->AlbumID) }}" class="btn-view">
                                <i class="bi bi-eye-fill"></i> Lihat
                            </a>
                            <form action="{{ route('album.destroy', $album->AlbumID) }}" method="POST" 
                                  onsubmit="return confirm('Hapus album beserta semua fotonya?')">
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
                <i class="bi bi-folder-open"></i>
            </div>
            <h3 class="empty-title">Belum Ada Album</h3>
            <p class="empty-text">Buat album pertama Anda untuk mengorganisir foto-foto</p>
            <a href="{{ route('album.create') }}" class="btn btn-create-album">
                <i class="bi bi-plus-circle"></i> Buat Album Pertama
            </a>
        </div>
    @endif
</div>
@endsection