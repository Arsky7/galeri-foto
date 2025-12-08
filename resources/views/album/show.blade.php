@extends('layouts.app')

@section('title', $album->NamaAlbum)

@section('content')

<a href="{{ route('album.index') }}" class="btn btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<div class="mb-4">
    <h2 class="fw-bold">{{ $album->NamaAlbum }}</h2>
    
    @if($album->Deskripsi)
    <p class="text-muted">{{ $album->Deskripsi }}</p>
    @endif
    
    <div class="text-muted small">
        <i class="bi bi-calendar"></i> {{ $album->TanggalDibuat->format('d M Y') }}
        <span class="ms-3"><i class="bi bi-images"></i> {{ $album->fotos->count() }} foto</span>
    </div>
</div>

@if($album->fotos->count() > 0)
<div class="foto-grid">
    @foreach($album->fotos as $foto)
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
        <h5 class="mt-3 text-muted">Album Masih Kosong</h5>
        <p class="text-muted">Belum ada foto di album ini</p>
        <a href="{{ route('foto.create') }}" class="btn btn-primary mt-3">
            <i class="bi bi-plus-circle"></i> Upload Foto
        </a>
    </div>
</div>
@endif

@endsection