@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* ========== ANIMATIONS ========== */
    @keyframes fadeSlideUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.03); }
    }

    /* ========== GLOBAL MODERN STYLES ========== */
    .modern-card {
        background: linear-gradient(135deg, rgba(20, 20, 20, 0.92) 0%, rgba(30, 30, 30, 0.88) 100%);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        border: 1px solid rgba(218, 165, 32, 0.2);
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4),
                    0 0 0 1px rgba(255, 215, 0, 0.05),
                    inset 0 1px 0 rgba(255, 255, 255, 0.05);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modern-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.5),
                    0 0 20px rgba(218, 165, 32, 0.15);
        border-color: rgba(218, 165, 32, 0.3);
    }

    /* ========== STATS CARDS ========== */
    .stats-container {
        opacity: 0;
        animation: fadeSlideUp 0.6s ease forwards;
    }

    .stats-card {
        animation: fadeSlideUp 0.7s ease forwards;
        position: relative;
        padding: 1.5rem;
        color: white;
    }

    .stats-card:nth-child(1) { animation-delay: 0.1s; background: linear-gradient(135deg, rgba(218, 165, 32, 0.15) 0%, rgba(30, 30, 30, 0.8) 100%); }
    .stats-card:nth-child(2) { animation-delay: 0.2s; background: linear-gradient(135deg, rgba(255, 215, 0, 0.12) 0%, rgba(30, 30, 30, 0.8) 100%); }
    .stats-card:nth-child(3) { animation-delay: 0.3s; background: linear-gradient(135deg, rgba(184, 134, 11, 0.15) 0%, rgba(30, 30, 30, 0.8) 100%); }

    .counter-number {
        font-size: 2.4rem;
        font-weight: 800;
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-block;
        min-width: 80px;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.2);
    }

    .stats-title {
        font-size: 0.85rem;
        color: #d4af37;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .stats-title i { font-size: 1.2rem; }

    .stats-icon {
        font-size: 3.2rem;
        color: rgba(218, 165, 32, 0.2);
        transition: all 0.4s ease;
        position: absolute;
        bottom: 1.2rem;
        right: 1.2rem;
    }

    .stats-card:hover .stats-icon {
        color: rgba(255, 215, 0, 0.4);
        transform: scale(1.2) rotate(10deg);
    }

    /* ========== FOTO GRID ========== */
    .foto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
    }

    .foto-card {
        position: relative;
        overflow: hidden;
        border-radius: 18px;
        animation: fadeSlideUp 0.8s ease both;
        background: rgba(15, 15, 15, 0.7);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .foto-card:hover {
        transform: translateY(-12px) scale(1.025);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.6),
                    0 0 20px rgba(218, 165, 32, 0.1);
        border: 1px solid rgba(218, 165, 32, 0.3);
    }

    .foto-card img {
        width: 100%;
        height: 230px;
        object-fit: cover;
        transition: transform 0.6s ease;
        display: block;
    }

    .foto-card:hover img {
        transform: scale(1.12) rotate(1deg);
    }

    .foto-overlay {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 1.25rem;
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, transparent 100%);
        color: #fff;
        opacity: 0;
        transition: all 0.4s ease;
        transform: translateY(20px);
    }

    .foto-card:hover .foto-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .foto-overlay h6 {
        font-weight: 700;
        margin-bottom: 0.6rem;
        font-size: 1.05rem;
        color: #FFD700;
        text-shadow: 0 0 8px rgba(0,0,0,0.8);
    }

    .foto-overlay small {
        display: flex;
        gap: 1rem;
        font-size: 0.85rem;
        color: #ccc;
    }
    .foto-overlay small i { color: #DAA520; }

    /* ========== EMPTY STATE ========== */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(20,20,20,0.9) 0%, rgba(30,30,30,0.9) 100%);
        border: 1px solid rgba(218,165,32,0.2);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        animation: fadeSlideUp 0.6s ease;
    }

    .empty-icon {
        width: 130px;
        height: 130px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, rgba(218,165,32,0.15) 0%, rgba(255,215,0,0.08) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s ease-in-out infinite;
        border: 2px solid rgba(218,165,32,0.3);
    }
    .empty-icon i {
        font-size: 4.2rem;
        color: #DAA520;
        text-shadow: 0 0 20px rgba(218,165,32,0.4);
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
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
        line-height: 1.6;
    }

    .btn-upload {
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #000;
        border: none;
        padding: 0.9rem 2.2rem;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(218,165,32,0.4);
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
    }
    .btn-upload:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(218,165,32,0.6);
        color: #000;
    }

    /* ========== SECTION HEADERS ========== */
    .section-header {
        opacity: 0;
        animation: fadeSlideUp 0.6s ease 0.3s forwards;
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
        margin-bottom: 0.25rem;
    }

    .section-subtitle {
        color: #aaa;
        font-size: 1.05rem;
        font-weight: 400;
    }

    .view-all-btn {
        color: #DAA520;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .view-all-btn:hover {
        color: #FFD700;
        gap: 0.7rem;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .foto-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 14px;
        }
        .foto-card img { height: 180px; }
        .counter-number { font-size: 2rem; }
        .section-title { font-size: 1.3rem; }
        .stats-card { padding: 1.2rem; }
    }

    @media (max-width: 576px) {
        .stats-card .counter-number { font-size: 1.7rem; }
        .stats-title { font-size: 0.75rem; }
        .stats-icon { font-size: 2.4rem; bottom: 1rem; right: 1rem; }
    }
</style>

<!-- Welcome Section -->
<div class="mb-5 section-header">
    <h2 class="section-title">
        <i class="bi bi-person-circle"></i> Selamat Datang, {{ $user->NamaLengkap }}!
    </h2>
    <p class="section-subtitle">Kelola galeri foto Anda dengan mudah dan cepat</p>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-5 stats-container">
    <div class="col-md-4">
        <div class="modern-card stats-card">
            <div class="stats-title">
                <i class="bi bi-images"></i> Total Foto
            </div>
            <div class="counter-number" data-target="{{ $totalFoto }}">0</div>
            <i class="bi bi-images stats-icon"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="modern-card stats-card">
            <div class="stats-title">
                <i class="bi bi-folder2-open"></i> Total Album
            </div>
            <div class="counter-number" data-target="{{ $totalAlbum }}">0</div>
            <i class="bi bi-folder-fill stats-icon"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="modern-card stats-card">
            <div class="stats-title">
                <i class="bi bi-heart-fill"></i> Total Likes
            </div>
            <div class="counter-number" data-target="{{ $totalLikes }}">0</div>
            <i class="bi bi-heart-fill stats-icon"></i>
        </div>
    </div>
</div>

<!-- My Latest Photos -->
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 section-header">
        <h4 class="section-title">
            <i class="bi bi-star-fill"></i> Foto Terbaru Saya
        </h4>
        <a href="{{ route('foto.index') }}" class="view-all-btn">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    @if($myPhotos->count())
        <div class="foto-grid">
            @foreach($myPhotos as $index => $foto)
                <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none"
                   style="animation-delay: {{ 0.5 + ($index * 0.1) }}s;">
                    <div class="foto-card">
                        <img src="{{ asset('storage/' . $foto->LokasiFile) }}" 
                             alt="{{ $foto->JudulFoto }}"
                             loading="lazy">
                        <div class="foto-overlay">
                            <h6 class="text-truncate">{{ $foto->JudulFoto }}</h6>
                            <small>
                                <span><i class="bi bi-heart-fill"></i> {{ $foto->likes_count }}</span>
                                <span><i class="bi bi-chat-fill"></i> {{ $foto->komentars_count }}</span>
                            </small>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-images"></i>
            </div>
            <h5 class="empty-title">Anda belum memiliki foto</h5>
            <p class="empty-text">Mulai berbagi momen indah Anda dengan upload foto pertama</p>
            <a href="{{ route('foto.create') }}" class="btn-upload">
                <i class="bi bi-cloud-upload"></i> Upload Foto
            </a>
        </div>
    @endif
</div>

<!-- Global Feed -->
<div>
    <div class="section-header mb-4">
        <h4 class="section-title">
            <i class="bi bi-globe"></i> Galeri Terbaru Semua Pengguna
        </h4>
        <p class="section-subtitle">Jelajahi foto-foto menarik dari komunitas</p>
    </div>
    
    <div class="foto-grid">
        @foreach($allPhotos as $index => $foto)
            <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-decoration-none"
               style="animation-delay: {{ 0.8 + ($index * 0.08) }}s;">
                <div class="foto-card">
                    <img src="{{ asset('storage/' . $foto->LokasiFile) }}" 
                         alt="{{ $foto->JudulFoto }}"
                         loading="lazy">
                    <div class="foto-overlay">
                        <h6 class="text-truncate">{{ $foto->JudulFoto }}</h6>
                        <small class="d-block mb-2">
                            <i class="bi bi-person-circle"></i> {{ $foto->user->Username }}
                        </small>
                        <small>
                            <span><i class="bi bi-heart-fill"></i> {{ $foto->likes_count }}</span>
                            <span><i class="bi bi-chat-fill"></i> {{ $foto->komentars_count }}</span>
                        </small>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')
<script>
// ========== COUNTER ANIMATION ==========
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter-number');
    
    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 1200;
        const increment = target / (duration / 16);
        let current = 0;
        
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        
        updateCounter();
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => observer.observe(counter));
});
</script>
@endsection