@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Welcome Section -->
<div class="mb-4">
    <h2 class="fw-bold">Selamat Datang, {{ $user->NamaLengkap }}! 👋</h2>
    <p class="text-muted">Kelola galeri foto Anda dengan mudah</p>
</div>

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Foto</h6>
                        <h2 class="fw-bold mb-0">{{ $totalFoto }}</h2>
                    </div>
                    <i class="bi bi-images" style="font-size: 3rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Album</h6>
                        <h2 class="fw-bold mb-0">{{ $totalAlbum }}</h2>
                    </div>
                    <i class="bi bi-folder-fill" style="font-size: 3rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Likes</h6>
                        <h2 class="fw-bold mb-0">{{ $totalLikes }}</h2>
                    </div>
                    <i class="bi bi-heart-fill" style="font-size: 3rem; opacity: 0.3;"></i>
                </div>
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
    
    @if($myPhotos->count() > 0)
    <div class="foto-grid">
        @foreach($myPhotos as $foto)
        <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none">
            <div class="foto-card">
                <img src="{{ asset('storage/' . $foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}">
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
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-images text-muted" style="font-size: 4rem;"></i>
            <h5 class="mt-3 text-muted">Anda belum memiliki foto</h5>
            <a href="{{ route('foto.create') }}" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle"></i> Upload Foto Pertama
            </a>
        </div>
    </div>
    @endif
</div>

<!-- All Photos Feed -->
<div>
    <h4 class="fw-bold mb-3">Galeri Terbaru</h4>
    <div class="foto-grid">
        @foreach($allPhotos as $foto)
        <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none">
            <div class="foto-card">
                <img src="{{ asset('storage/' . $foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}">
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