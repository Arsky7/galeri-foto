@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Custom Style Within This View -->
<style>
    /* Animasi Fade-in + Slide */
    @keyframes fadeSlideUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeSlideUp 0.7s ease forwards;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 16px;
    }

    /* Hover Card Statistik */
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    }

    /* Foto Grid Style */
    .foto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 18px;
    }

    .foto-card {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        animation: fadeSlideUp 0.8s ease both;
    }

    .foto-card img {
        width: 100%;
        height: 210px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    /* Zoom saat hover */
    .foto-card:hover img {
        transform: scale(1.12);
    }

    /* Overlay blur + gradient */
    .foto-overlay {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 12px;
        background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
        color: #fff;
        opacity: 0;
        backdrop-filter: blur(3px);
        transition: 0.35s ease;
        transform: translateY(20px);
    }

    /* Overlay muncul saat hover */
    .foto-card:hover .foto-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    /* Like & Comment Effekt */
    .foto-overlay i {
        transition: transform 0.3s ease;
    }

    .foto-overlay small:hover i {
        transform: scale(1.25);
    }
</style>


<!-- Welcome Section -->
<div class="mb-4">
    <h2 class="fw-bold">Selamat Datang, {{ $user->NamaLengkap }}! 👋</h2>
    <p class="text-muted">Kelola galeri foto Anda dengan mudah</p>
</div>


<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Total Foto</h6>
                    <h2 class="fw-bold mb-0">{{ $totalFoto }}</h2>
                </div>
                <i class="bi bi-images fs-1 opacity-25"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Total Album</h6>
                    <h2 class="fw-bold mb-0">{{ $totalAlbum }}</h2>
                </div>
                <i class="bi bi-folder-fill fs-1 opacity-25"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-danger">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Total Likes</h6>
                    <h2 class="fw-bold mb-0">{{ $totalLikes }}</h2>
                </div>
                <i class="bi bi-heart-fill fs-1 opacity-25"></i>
            </div>
        </div>
    </div>
</div>


<!-- My Latest Photos -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Foto Terbaru Saya</h4>
        <a href="{{ route('foto.index') }}" class="btn btn-sm btn-outline-primary">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    @if($myPhotos->count())
        <div class="foto-grid">
            @foreach($myPhotos as $index => $foto)
                <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none"
                   style="animation-delay: {{ $index * 0.08 }}s;">
                    <div class="foto-card">
                        <img src="{{ asset('storage/' . $foto->LokasiFile) }}">
                        <div class="foto-overlay">
                            <h6 class="fw-bold mb-1">{{ $foto->JudulFoto }}</h6>
                            <small>
                                <i class="bi bi-heart-fill"></i> {{ $foto->likes->count() }}
                                <i class="bi bi-chat-fill ms-2"></i> {{ $foto->komentars->count() }}
                            </small>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="card text-center py-5">
            <i class="bi bi-images text-muted" style="font-size: 4rem;"></i>
            <h5 class="mt-3 text-muted">Anda belum memiliki foto</h5>
            <a href="{{ route('foto.create') }}" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle"></i> Upload Foto Pertama
            </a>
        </div>
    @endif
</div>


<!-- Global Feed -->
<div>
    <h4 class="fw-bold mb-3">Galeri Terbaru</h4>
    <div class="foto-grid">
        @foreach($allPhotos as $index => $foto)
            <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none"
               style="animation-delay: {{ $index * 0.06 }}s;">
                <div class="foto-card">
                    <img src="{{ asset('storage/' . $foto->LokasiFile) }}">
                    <div class="foto-overlay">
                        <h6 class="fw-bold mb-1">{{ $foto->JudulFoto }}</h6>
                        <small class="d-block mb-2">
                            <i class="bi bi-person-circle"></i> {{ $foto->user->Username }}
                        </small>
                        <small>
                            <i class="bi bi-heart-fill"></i> {{ $foto->likes->count() }}
                            <i class="bi bi-chat-fill ms-2"></i> {{ $foto->komentars->count() }}
                        </small>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

@endsection
