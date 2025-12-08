@extends('layouts.app')

@section('title', 'Daftar Album')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Album Saya</h2>
        <p class="text-muted mb-0">Kelola album foto Anda</p>
    </div>
    <a href="{{ route('album.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Buat Album
    </a>
</div>

@if($albums->count() > 0)
<div class="row g-4">
    @foreach($albums as $album)
    <div class="col-md-4">
        <div class="card h-100">
            
            <!-- Album Cover -->
            <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position: relative;">
                @if($album->fotos_count > 0 && $album->fotos->first())
                <img src="{{ asset('storage/' . $album->fotos->first()->LokasiFile) }}" 
                     class="w-100 h-100 object-fit-cover" 
                     alt="{{ $album->NamaAlbum }}">
                @else
                <div class="d-flex align-items-center justify-content-center h-100">
                    <i class="bi bi-folder-open text-white" style="font-size: 4rem; opacity: 0.5;"></i>
                </div>
                @endif
                
                <span class="position-absolute top-0 end-0 m-2 badge bg-dark">
                    <i class="bi bi-images"></i> {{ $album->fotos_count }}
                </span>
            </div>
            
            <!-- Album Info -->
            <div class="card-body">
                <h5 class="card-title fw-bold">{{ $album->NamaAlbum }}</h5>
                
                @if($album->Deskripsi)
                <p class="card-text text-muted small">{{ Str::limit($album->Deskripsi, 100) }}</p>
                @else
                <p class="card-text text-muted small fst-italic">Tidak ada deskripsi</p>
                @endif
                
                <small class="text-muted">
                    <i class="bi bi-calendar"></i> {{ $album->TanggalDibuat->format('d M Y') }}
                </small>
                
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('album.show', $album->AlbumID) }}" class="btn btn-sm btn-primary flex-fill">
                        <i class="bi bi-eye"></i> Lihat
                    </a>
                    <form action="{{ route('album.destroy', $album->AlbumID) }}" 
                          method="POST" 
                          onsubmit="return confirm('Yakin hapus album dan semua fotonya?')"
                          class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger w-100">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-folder-open text-muted" style="font-size: 4rem;"></i>
        <h5 class="mt-3 text-muted">Belum Ada Album</h5>
        <p class="text-muted">Buat album pertama Anda untuk mulai mengorganisir foto</p>
        <a href="{{ route('album.create') }}" class="btn btn-primary mt-3">
            <i class="bi bi-plus-circle"></i> Buat Album Baru
        </a>
    </div>
</div>
@endif

@endsection