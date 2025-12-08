@extends('layouts.app')

@section('title', 'Galeri Foto')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">Galeri Foto</h2>
    <p class="text-muted">Jelajahi foto-foto dari seluruh pengguna</p>
</div>

@if($fotos->count() > 0)
<div class="foto-grid">
    @foreach($fotos as $foto)
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

<!-- Pagination -->
<div class="mt-4">
    {{ $fotos->links() }}
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-images text-muted" style="font-size: 4rem;"></i>
        <h5 class="mt-3 text-muted">Belum Ada Foto</h5>
        <p class="text-muted">Jadilah yang pertama upload foto!</p>
        <a href="{{ route('foto.create') }}" class="btn btn-primary mt-3">
            <i class="bi bi-plus-circle"></i> Upload Foto Pertama
        </a>
    </div>
</div>
@endif

@endsection