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
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }
    
    .btn-back-custom:hover {
        transform: translateX(-5px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        color: white;
    }
    
    .foto-main-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        background: white;
    }
    
    .foto-image-container {
        position: relative;
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        padding: 1rem;
    }
    
    .foto-image-container img {
        width: 100%;
        height: auto;
        max-height: 600px;
        object-fit: contain;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .btn-delete-custom {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }
    
    .btn-delete-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
    }
    
    .info-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        background: white;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    
    .user-info-section {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, #ebf4f5 0%, #b5c6e0 100%);
        border-bottom: 3px solid #3498db;
    }
    
    .user-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.75rem;
        font-weight: 700;
        margin-right: 1rem;
        border: 3px solid white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .user-info h6 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.25rem;
    }
    
    .user-info small {
        color: #7f8c8d;
        font-weight: 500;
    }
    
    .foto-content {
        padding: 1.5rem;
    }
    
    .foto-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        line-height: 1.4;
    }
    
    .foto-description {
        color: #7f8c8d;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }
    
    .meta-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem;
        background: #f8f9fa;
        border-radius: 10px;
        font-size: 0.9rem;
        color: #2c3e50;
    }
    
    .meta-item i {
        color: #3498db;
        font-size: 1.1rem;
    }
    
    .btn-like {
        width: 100%;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.05rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border: none;
    }
    
    .btn-like.liked {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
    }
    
    .btn-like.not-liked {
        background: white;
        color: #e74c3c;
        border: 2px solid #e74c3c;
    }
    
    .btn-like:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
    }
    
    .comments-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        background: white;
        overflow: hidden;
    }
    
    .comments-header {
        padding: 1.5rem;
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: white;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .comments-header h5 {
        margin: 0;
        font-weight: 700;
    }
    
    .comment-count-badge {
        background: rgba(255, 255, 255, 0.25);
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.9rem;
    }
    
    .comment-form {
        padding: 1.5rem;
        background: #f8f9fa;
    }
    
    .comment-textarea {
        border: 2px solid #e0e6ed;
        border-radius: 12px;
        padding: 1rem;
        resize: vertical;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }
    
    .comment-textarea:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        outline: none;
    }
    
    .btn-send-comment {
        width: 100%;
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 0.875rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-send-comment:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
    }
    
    .comments-list {
        padding: 1.5rem;
        max-height: 500px;
        overflow-y: auto;
    }
    
    .comment-item {
        padding: 1.25rem;
        background: #f8f9fa;
        border-radius: 12px;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        border-left: 4px solid #3498db;
    }
    
    .comment-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }
    
    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }
    
    .comment-author {
        font-weight: 700;
        color: #2c3e50;
        font-size: 0.95rem;
    }
    
    .btn-delete-comment {
        background: none;
        border: none;
        color: #e74c3c;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .btn-delete-comment:hover {
        background: #fee;
        transform: scale(1.1);
    }
    
    .comment-text {
        color: #2c3e50;
        line-height: 1.6;
        margin-bottom: 0.75rem;
    }
    
    .comment-date {
        color: #7f8c8d;
        font-size: 0.85rem;
    }
    
    .empty-comments {
        text-align: center;
        padding: 3rem 1.5rem;
        color: #7f8c8d;
    }
    
    .empty-comments i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
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
                <!-- User Info -->
                <div class="user-info-section">
                    <div class="user-avatar">
                        {{ substr($foto->user->NamaLengkap, 0, 1) }}
                    </div>
                    <div class="user-info">
                        <h6>{{ $foto->user->NamaLengkap }}</h6>
                        <small>@{{ $foto->user->Username }}</small>
                    </div>
                </div>
                
                <!-- Foto Content -->
                <div class="foto-content">
                    <h4 class="foto-title">{{ $foto->JudulFoto }}</h4>
                    
                    @if($foto->DeskripsiFoto)
                    <p class="foto-description">{{ $foto->DeskripsiFoto }}</p>
                    @else
                    <p class="foto-description fst-italic">Tidak ada deskripsi</p>
                    @endif
                    
                    <!-- Meta Info -->
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
                    
                    <!-- Like Button -->
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
                
                <!-- Form Komentar -->
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
                
                <!-- List Komentar -->
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
                likeButton.classList.remove('not-liked');
                likeButton.classList.add('liked');
                document.getElementById('likeText').textContent = 'Disukai';
            } else {
                likeButton.classList.remove('liked');
                likeButton.classList.add('not-liked');
                document.getElementById('likeText').textContent = 'Suka';
            }
            
            document.getElementById('likeCount').textContent = result.data.likeCount;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat melakukan like');
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
                <div class="comment-item" data-komentar-id="${result.data.KomentarID}">
                    <div class="comment-header">
                        <span class="comment-author">${result.data.user.NamaLengkap}</span>
                        <button onclick="deleteKomentar(${result.data.KomentarID})" 
                                class="btn-delete-comment">
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
        alert('Terjadi kesalahan saat mengirim komentar');
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
            
            // Show empty state if no comments
            const commentsList = document.getElementById('komentarList');
            if (commentsList.children.length === 0) {
                commentsList.innerHTML = `
                    <div class="empty-comments" id="emptyKomentar">
                        <i class="bi bi-chat-square-text"></i>
                        <p>Belum ada komentar.<br>Jadilah yang pertama berkomentar!</p>
                    </div>
                `;
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus komentar');
    }
}
</script>
@endsection