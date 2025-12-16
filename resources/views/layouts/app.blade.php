<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Galeri Foto') - GaleriKu</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --gold: #DAA520;
            --gold-light: #FFD700;
            --gold-dark: #B8860B;
            --bg-dark: #0f0f0f;
            --bg-card: #1a1a1a;
            --text-light: #e0e0e0;
            --text-muted: #aaa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0a0a;
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--text-light);
            position: relative;
        }

        /* Animated Gradient Background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, 
                #0a0a0a 0%, 
                #1a1a1a 25%, 
                #0f0f0f 50%, 
                #1a1a1a 75%, 
                #0a0a0a 100%);
            background-size: 400% 400%;
            animation: gradientFlow 20s ease infinite;
            z-index: 0;
        }
        @keyframes gradientFlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Navbar */
        .navbar {
            background: rgba(15, 15, 15, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(218, 165, 32, 0.2);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.5),
                        inset 0 0 0 1px rgba(255, 215, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.55rem;
            color: #FFD700 !important;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 10px rgba(218, 165, 32, 0.4);
        }
        .navbar-brand:hover {
            transform: scale(1.06);
            color: #DAA520 !important;
        }
        .navbar-brand i {
            font-size: 1.8rem;
            animation: iconGlow 3s ease-in-out infinite;
        }
        @keyframes iconGlow {
            0%, 100% { text-shadow: 0 0 10px rgba(218, 165, 32, 0.4); }
            50% { text-shadow: 0 0 20px rgba(255, 215, 0, 0.6); }
        }

        .nav-link {
            color: rgba(218, 165, 32, 0.85) !important;
            font-weight: 600;
            padding: 0.75rem 1.25rem !important;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }
        .nav-link:hover {
            color: #FFD700 !important;
            background: rgba(218, 165, 32, 0.08);
            transform: translateY(-2px);
        }
        .nav-link.active {
            color: #FFD700 !important;
            background: linear-gradient(135deg, rgba(218,165,32,0.15) 0%, rgba(255,215,0,0.1) 100%);
            box-shadow: 0 0 15px rgba(218,165,32,0.2);
            border: 1px solid rgba(218,165,32,0.3);
        }

        .btn-upload-nav {
            background: linear-gradient(135deg, rgba(218,165,32,0.15) 0%, rgba(255,215,0,0.1) 100%);
            border: 1px solid rgba(218,165,32,0.3);
            color: #FFD700;
            padding: 0.625rem 1.5rem;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-upload-nav:hover {
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            color: #000;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(218,165,32,0.4);
        }

        .dropdown-toggle {
            background: rgba(218,165,32,0.1);
            border: 1px solid rgba(218,165,32,0.3);
            color: #FFD700 !important;
            padding: 0.625rem 1.25rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dropdown-toggle:hover {
            background: rgba(218,165,32,0.25);
            transform: translateY(-2px);
        }
        .dropdown-toggle::after {
            border-color: #FFD700 transparent transparent transparent;
        }

        .dropdown-menu {
            background: rgba(20, 20, 20, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(218,165,32,0.2);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.6),
                        0 0 15px rgba(218,165,32,0.2);
            padding: 0.5rem;
            margin-top: 0.5rem;
        }

        .dropdown-header {
            font-weight: 700;
            color: #FFD700;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
        }

        .dropdown-item {
            color: var(--text-light);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        .dropdown-item:hover {
            background: rgba(218,165,32,0.1);
            border-color: rgba(218,165,32,0.3);
            transform: translateX(4px);
            color: #FFD700;
        }
        .dropdown-item.text-danger:hover {
            background: rgba(220,53,69,0.15);
            color: #ff6b6b !important;
            border-color: rgba(220,53,69,0.3);
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            animation: slideDown 0.5s ease;
            border-left: 4px solid;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success {
            background: rgba(40, 167, 69, 0.15);
            color: #51cf66;
            border-left-color: #51cf66;
        }
        .alert-danger {
            background: rgba(220, 53, 69, 0.15);
            color: #ff6b6b;
            border-left-color: #ff6b6b;
        }

        /* Main Content */
        main {
            position: relative;
            z-index: 1;
            padding: 2rem 0;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #111;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #DAA520, #B8860B);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #FFD700;
        }

        @media (max-width: 768px) {
            .navbar-brand { font-size: 1.3rem; }
            .nav-link { padding: 0.5rem 1rem !important; font-size: 0.95rem; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-camera-fill"></i>
                <span>GaleriKu</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('foto.*') ? 'active' : '' }}" 
                           href="{{ route('foto.index') }}">
                            <i class="bi bi-images"></i> Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('album.*') ? 'active' : '' }}" 
                           href="{{ route('album.index') }}">
                            <i class="bi bi-folder-fill"></i> Album
                        </a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('foto.create') }}" class="btn-upload-nav">
                        <i class="bi bi-cloud-upload-fill"></i> Upload
                    </a>
                    
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            <span>{{ auth()->user()->NamaLengkap }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <h6 class="dropdown-header">
                                    <i class="bi bi-envelope"></i> {{ auth()->user()->Email }}
                                </h6>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="color: inherit;"></button>
        </div>
    </div>
    @endif
    
    @if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="color: inherit;"></button>
        </div>
    </div>
    @endif

    <main class="container py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>