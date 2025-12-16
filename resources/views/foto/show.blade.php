@extends('layouts.app')

@section('title', $foto->JudulFoto)

@section('content')
<style>
    .foto-detail-container {
        animation: fadeIn 0.6s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .btn-back-custom {
        background: linear-gradient(135deg, rgba(218,165,32,0.15) 0%, rgba(255,215,0,0.1) 100%);
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
    .btn-back-custom:hover {
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #000;
        transform: translateX(-5px);
        box-shadow: 0 6px 20px rgba(218,165,32,0.3);
    }

    .foto-main-card {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        border-radius: 22px;
        overflow: hidden;
        border: 1px solid rgba(218,165,32,0.2);
        box-shadow: 0 15px 50px rgba(0,0,0,0.5);
    }

    .foto-image-container {
        padding: 1.5rem;
        background: #0f0f0f;
    }

    .foto-image-container img {
        width: 100%;
        max-height: 600px;
        object-fit: contain;
        border-radius: 18px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.7);
        display: block;
        margin: 0 auto;
    }

    .btn-delete-custom {
        background: linear-gradient(135deg, rgba(220,53,69,0.2) 0%, rgba(192,57,43,0.2) 100%);
        color: #ff6b6b;
        border: 1px solid rgba(220,53,69,0.3);
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        margin-top: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-delete-custom:hover {
        background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(220,53,69,0.4);
    }

    .info-card {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        border-radius: 22px;
        border: 1px solid rgba(218,165,32,0.2);
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        margin-bottom: 1.8rem;
        overflow: hidden;
    }

    .user-info-section {
        padding: 1.5rem;
        background: rgba(218,165,32,0.08);
        border-bottom: 2px solid rgba(218,165,32,0.3);
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #DAA520, #FFD700);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-size: 1.75rem;
        font-weight: 800;
        margin-right: 1.2rem;
        border: 3px solid rgba(255,255,255,0.2);
        box-shadow: 0 4px 15px rgba(218,165,32,0.25);
    }

    .user-info h6 {
        font-weight: 700;
        color: #FFD700;
        margin-bottom: 0.3rem;
        font-size: 1.1rem;
    }
    .user-info small {
        color: #aaa;
        font-weight: 500;
    }

    .foto-content {
        padding: 1.7rem;
    }

    .foto-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: #FFD700;
        margin-bottom: 1.2rem;
        line-height: 1.4;
        text-shadow: 0 0 8px rgba(0,0,0,0.5);
    }

    .foto-description {
        color: #ccc;
        line-height: 1.7;
        margin-bottom: 1.8rem;
        font-size: 1.02rem;
    }
    .foto-description.fst-italic {
        color: #888;
    }

    .meta-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1.1rem;
        margin-bottom: 1.8rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem;
        background: rgba(30,30,30,0.6);
        border-radius: 10px;
        border: 1px solid rgba(218,165,32,0.15);
        font-size: 0.95rem;
        color: #ddd;
    }
    .meta-item i {
        color: #DAA520;
        font-size: 1.2rem;
    }

    .btn-like {
        width: 100%;
        padding: 1.1rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.7rem;
        border: none;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .btn-like.liked {
        background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
        color: white;
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
    }

    .btn-like.not-liked {
        background: rgba(30,30,30,0.7);
        color: #DAA520;
        border: 1px solid rgba(218,165,32,0.3);
    }

    .btn-like:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(218,165,32,0.4);
    }

    .comments-card {
        background: linear-gradient(135deg, rgba(20,20,20,0.95) 0%, rgba(30,30,30,0.9) 100%);
        border-radius: 22px;
        border: 1px solid rgba(218,165,32,0.2);
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        overflow: hidden;
    }

    .comments-header {
        padding: 1.5rem;
        background: rgba(218,165,32,0.1);
        color: #FFD700;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        border-bottom: 1px solid rgba(218,165,32,0.2);
    }

    .comments-header h5 {
        margin: 0;
        font-weight: 800;
        font-size: 1.25rem;
    }

    .comment-count-badge {
        background: rgba(218,165,32,0.25);
        color: #FFD700;
        padding: 0.25rem 0.85rem;
        border-radius: 50px;
        font-size: 0.95rem;
        font-weight: 700;
    }

    .comment-form {
        padding: 1.5rem;
        background: rgba(15,15,15,0.7);
    }

    .comment-textarea {
        background: rgba(30,30,30,0.8);
        border: 1px solid rgba(218,165,32,0.2);
        border-radius: 12px;
        padding: 1rem;
        color: white;
        resize: vertical;
        transition: all 0.3s ease;
        margin-bottom: 1.2rem;
        font-size: 1rem;
    }
    .comment-textarea::placeholder {
        color: rgba(255,255,255,0.4);
    }
    .comment-textarea:focus {
        border-color: #DAA520;
        box-shadow: 0 0 0 4px rgba(218,165,32,0.2);
        outline: none;
        background: rgba(35,35,35,0.9);
    }

    .btn-send-comment {
        width: 100%;
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #000;
        border: none;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 6px 20px rgba(218,165,32,0.4);
    }

    .btn-send-comment:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(218,165,32,0.6);
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
    }

    .comments-list {
        padding: 0 1.5rem 1.5rem;
        max-height: 500px;
        overflow-y: auto;
    }

    .comment-item {
        padding: 1.3rem;
        background: rgba(25,25,25,0.8);
        border-radius: 12px;
        margin-bottom: 1.2rem;
        transition: all 0.3s ease;
        border-left: 3px solid #DAA520;
        border: 1px solid rgba(218,165,32,0.1);
    }

    .comment-item:hover {
        background: rgba(30,30,30,0.9);
        transform: translateX(4px);
        border-color: rgba(218,165,32,0.3);
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
    }

    .comment-author {
        font-weight: 700;
        color: #FFD700;
        font-size: 1rem;
    }

    .btn-delete-comment {
        background: none;
        border: none;
        color: #ff6b6b;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .btn-delete-comment:hover {
        background: rgba(220,53,69,0.15);
        color: #e74c3c;
        transform: scale(1.15);
    }

    .comment-text {
        color: #ddd;
        line-height: 1.7;
        margin-bottom: 0.8rem;
        font-size: 1.02rem;
    }

    .comment-date {
        color: #888;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .empty-comments {
        text-align: center;
        padding: 3rem 1.5rem;
        color: #888;
    }

    .empty-comments i {
        font-size: 3.5rem;
        margin-bottom: 1.2rem;
        color: rgba(218,165,32,0.3);
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.6; }
    }

    /* Scrollbar */
    .comments-list::-webkit-scrollbar {
        width: 8px;
    }
    .comments-list::-webkit-scrollbar-track {
        background: #1a1a1a;
    }
    .comments-list::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #DAA520, #B8860B);
        border-radius: 4px;
    }
</style>

<div class="foto-detail-container">
    <a href="{{ route('foto.index') }}" class="btn-back-custom">
        <i class="bi bi-arrow-left-circle"></i>
        Kembali ke Galeri
    </a>

    <div class="row">
        <!-- Foto - Left Side -->
        <div class="col-lg-8">
            <div class="foto-main-card">
                <div class="foto-image-container">
                    <img src="{{ asset('storage/' . $foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}">
                </div>
            </div>
            
            @if(auth()->id() == $foto->UserID)
            <form action="{{ route('foto.destroy', $foto->FotoID) }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus foto ini? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-custom">
                    <i class="bi bi-trash3-fill"></i>
                    Hapus Foto
                </button>
            </form>
            @endif
        </div>
        
        <!-- Info & Comments - Right Side -->
        <div class="col-lg-4">
            <!-- Foto Info Card -->
            <div class="info-card">
                <div class="user-info-section">
                    <div class="user-avatar">
                        {{ substr($foto->user->NamaLengkap, 0, 1) }}
                    </div>
                    <div class="user-info">
                        <h6>{{ $foto->user->NamaLengkap }}</h6>
                        <small>@{{ $foto->user->Username }}</small>
                    </div>
                </div>
                
                <div class="foto-content">
                    <h4 class="foto-title">{{ $foto->JudulFoto }}</h4>
                    
                    @if($foto->DeskripsiFoto)
                    <p class="foto-description">{{ $foto->DeskripsiFoto }}</p>
                    @else
                    <p class="foto-description fst-italic">Tidak ada deskripsi</p>
                    @endif
                    
                    <div class="meta-info">
                        <div class="meta-item">
                            <i class="bi bi-folder-fill"></i>
                            <span>{{ $foto->album->NamaAlbum }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>{{ $foto->TanggalUnggah->format('d M Y') }}</span>
                        </div>
                    </div>
                    
                    <button id="likeButton" 
                            data-foto-id="{{ $foto->FotoID }}"
                            class="btn-like {{ $isLiked ? 'liked' : 'not-liked' }}">
                        <i class="bi bi-heart-fill"></i>
                        <span id="likeText">{{ $isLiked ? 'Disukai' : 'Suka' }}</span>
                        (<span id="likeCount">{{ $foto->likes->count() }}</span>)
                    </button>
                </div>
            </div>
            
            <!-- Comments Section -->
            <div class="comments-card">
                <div class="comments-header">
                    <i class="bi bi-chat-dots-fill" style="font-size: 1.5rem;"></i>
                    <h5>Komentar</h5>
                    <span class="comment-count-badge">
                        <span id="komentarCount">{{ $foto->komentars->count() }}</span>
                    </span>
                </div>
                
                <div class="comment-form">
                    <form id="komentarForm">
                        <textarea id="komentarInput" 
                                  class="form-control comment-textarea" 
                                  rows="3"
                                  placeholder="Tulis komentar Anda..."
                                  required></textarea>
                        <button type="submit" class="btn-send-comment">
                            <i class="bi bi-send-fill"></i>
                            Kirim Komentar
                        </button>
                    </form>
                </div>
                
                <div class="comments-list" id="komentarList">
                    @forelse($foto->komentars as $komentar)
                    <div class="comment-item" data-komentar-id="{{ $komentar->KomentarID }}">
                        <div class="comment-header">
                            <span class="comment-author">{{ $komentar->user->NamaLengkap }}</span>
                            @if(auth()->id() == $komentar->UserID)
                            <button onclick="deleteKomentar({{ $komentar->KomentarID }})" 
                                    class="btn-delete-comment">
                                <i class="bi bi-trash3"></i>
                            </button>
                            @endif
                        </div>
                        <p class="comment-text">{{ $komentar->IsiKomentar }}</p>
                        <small class="comment-date">
                            <i class="bi bi-clock"></i> {{ $komentar->TanggalKomentar->format('d M Y, H:i') }}
                        </small>
                    </div>
                    @empty
                    <div class="empty-comments" id="emptyKomentar">
                        <i class="bi bi-chat-square-text"></i>
                        <p>Belum ada komentar.<br>Jadilah yang pertama berkomentar!</p>
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

// LIKE
const likeButton = document.getElementById('likeButton');
likeButton?.addEventListener('click', async function() {
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
            likeButton.classList.toggle('not-liked', !isLiked);
            likeButton.classList.toggle('liked', isLiked);
            document.getElementById('likeText').textContent = isLiked ? 'Disukai' : 'Suka';
            document.getElementById('likeCount').textContent = result.data.likeCount;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Gagal memberi like.');
    }
});

// KOMENTAR
const komentarForm = document.getElementById('komentarForm');
komentarForm?.addEventListener('submit', async function(e) {
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
                <div class="comment-item" data-komentar-id="${result.data.KomentarID}">
                    <div class="comment-header">
                        <span class="comment-author">${result.data.user.NamaLengkap}</span>
                        <button onclick="deleteKomentar(${result.data.KomentarID})" class="btn-delete-comment">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </div>
                    <p class="comment-text">${result.data.IsiKomentar}</p>
                    <small class="comment-date">
                        <i class="bi bi-clock"></i> ${result.data.TanggalKomentar}
                    </small>
                </div>
            `;
            
            document.getElementById('komentarList').insertAdjacentHTML('afterbegin', newKomentar);
            document.getElementById('komentarCount').textContent = parseInt(document.getElementById('komentarCount').textContent) + 1;
            document.getElementById('komentarInput').value = '';
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Gagal mengirim komentar.');
    }
});

// HAPUS KOMENTAR
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
            const countEl = document.getElementById('komentarCount');
            countEl.textContent = Math.max(0, parseInt(countEl.textContent) - 1);
            
            const list = document.getElementById('komentarList');
            if (list.children.length === 0) {
                list.innerHTML = `
                    <div class="empty-comments" id="emptyKomentar">
                        <i class="bi bi-chat-square-text"></i>
                        <p>Belum ada komentar.<br>Jadilah yang pertama berkomentar!</p>
                    </div>
                `;
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Gagal menghapus komentar.');
    }
}
</script>
@endsection