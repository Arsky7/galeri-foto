@extends('layouts.app')

@section('title', $foto->JudulFoto)

@section('content')

<a href="{{ route('foto.index') }}" class="btn btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<div class="row">
    <!-- Foto - Left Side -->
    <div class="col-md-8">
        <div class="card mb-3">
            <img src="{{ asset('storage/' . $foto->LokasiFile) }}" class="card-img-top" alt="{{ $foto->JudulFoto }}">
        </div>
        
        @if(auth()->id() == $foto->UserID)
        <form action="{{ route('foto.destroy', $foto->FotoID) }}" method="POST" 
              onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash"></i> Hapus Foto
            </button>
        </form>
        @endif
    </div>
    
    <!-- Info & Comments - Right Side -->
    <div class="col-md-4">
        
        <!-- Foto Info -->
        <div class="card mb-3">
            <div class="card-body">
                
                <!-- User Info -->
                <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-3" 
                         style="width: 50px; height: 50px; font-size: 1.5rem;">
                        {{ substr($foto->user->NamaLengkap, 0, 1) }}
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $foto->user->NamaLengkap }}</h6>
                        <small class="text-muted">@{{ $foto->user->Username }}</small>
                    </div>
                </div>
                
                <!-- Judul & Deskripsi -->
                <h4 class="fw-bold mb-2">{{ $foto->JudulFoto }}</h4>
                @if($foto->DeskripsiFoto)
                <p class="text-muted mb-3">{{ $foto->DeskripsiFoto }}</p>
                @endif
                
                <!-- Meta Info -->
                <div class="mb-3">
                    <small class="text-muted d-block">
                        <i class="bi bi-folder"></i> {{ $foto->album->NamaAlbum }}
                    </small>
                    <small class="text-muted d-block">
                        <i class="bi bi-calendar"></i> {{ $foto->TanggalUnggah->format('d M Y') }}
                    </small>
                </div>
                
                <!-- Like Button -->
                <button id="likeButton" 
                        data-foto-id="{{ $foto->FotoID }}"
                        class="btn w-100 {{ $isLiked ? 'btn-danger' : 'btn-outline-danger' }}">
                    <i class="bi bi-heart-fill"></i>
                    <span id="likeText">{{ $isLiked ? 'Disukai' : 'Suka' }}</span>
                    (<span id="likeCount">{{ $foto->likes->count() }}</span>)
                </button>
            </div>
        </div>
        
        <!-- Comments Section -->
        <div class="card">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-chat-dots"></i> Komentar (<span id="komentarCount">{{ $foto->komentars->count() }}</span>)
                </h5>
                
                <!-- Form Komentar -->
                <form id="komentarForm" class="mb-3">
                    <textarea id="komentarInput" 
                              class="form-control mb-2" 
                              rows="2"
                              placeholder="Tulis komentar..."
                              required></textarea>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-send-fill"></i> Kirim
                    </button>
                </form>
                
                <!-- List Komentar -->
                <div id="komentarList" style="max-height: 400px; overflow-y: auto;">
                    @forelse($foto->komentars as $komentar)
                    <div class="border-bottom pb-2 mb-2" data-komentar-id="{{ $komentar->KomentarID }}">
                        <div class="d-flex justify-content-between">
                            <strong class="small">{{ $komentar->user->NamaLengkap }}</strong>
                            @if(auth()->id() == $komentar->UserID)
                            <button onclick="deleteKomentar({{ $komentar->KomentarID }})" 
                                    class="btn btn-sm btn-link text-danger p-0">
                                <i class="bi bi-trash"></i>
                            </button>
                            @endif
                        </div>
                        <p class="mb-1 small">{{ $komentar->IsiKomentar }}</p>
                        <small class="text-muted">{{ $komentar->TanggalKomentar->format('d M Y') }}</small>
                    </div>
                    @empty
                    <div id="emptyKomentar" class="text-center text-muted py-3">
                        <i class="bi bi-chat"></i> Belum ada komentar
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// LIKE FUNCTIONALITY
const likeButton = document.getElementById('likeButton');
likeButton.addEventListener('click', async function() {
    try {
        const response = await fetch('/like/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ FotoID: this.dataset.fotoId })
        });
        
        const result = await response.json();
        
        if (result.success) {
            const isLiked = result.data.isLiked;
            
            if (isLiked) {
                likeButton.classList.remove('btn-outline-danger');
                likeButton.classList.add('btn-danger');
                document.getElementById('likeText').textContent = 'Disukai';
            } else {
                likeButton.classList.remove('btn-danger');
                likeButton.classList.add('btn-outline-danger');
                document.getElementById('likeText').textContent = 'Suka';
            }
            
            document.getElementById('likeCount').textContent = result.data.likeCount;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    }
});

// KOMENTAR FUNCTIONALITY
const komentarForm = document.getElementById('komentarForm');
komentarForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const isiKomentar = document.getElementById('komentarInput').value.trim();
    if (!isiKomentar) return;
    
    try {
        const response = await fetch('/komentar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                FotoID: {{ $foto->FotoID }},
                IsiKomentar: isiKomentar
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            const emptyState = document.getElementById('emptyKomentar');
            if (emptyState) emptyState.remove();
            
            const newKomentar = `
                <div class="border-bottom pb-2 mb-2" data-komentar-id="${result.data.KomentarID}">
                    <div class="d-flex justify-content-between">
                        <strong class="small">${result.data.user.NamaLengkap}</strong>
                        <button onclick="deleteKomentar(${result.data.KomentarID})" 
                                class="btn btn-sm btn-link text-danger p-0">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <p class="mb-1 small">${result.data.IsiKomentar}</p>
                    <small class="text-muted">${result.data.TanggalKomentar}</small>
                </div>
            `;
            
            document.getElementById('komentarList').insertAdjacentHTML('afterbegin', newKomentar);
            document.getElementById('komentarCount').textContent = parseInt(document.getElementById('komentarCount').textContent) + 1;
            document.getElementById('komentarInput').value = '';
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    }
});

// DELETE KOMENTAR
async function deleteKomentar(komentarId) {
    if (!confirm('Hapus komentar ini?')) return;
    
    try {
        const response = await fetch(`/komentar/${komentarId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken }
        });
        
        const result = await response.json();
        
        if (result.success) {
            document.querySelector(`[data-komentar-id="${komentarId}"]`).remove();
            document.getElementById('komentarCount').textContent = parseInt(document.getElementById('komentarCount').textContent) - 1;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    }
}
</script>
@endsection