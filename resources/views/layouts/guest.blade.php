<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - GaleriKu</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: #0a0a0a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
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

        /* Floating Golden Orbs & Particles */
        body::after,
        .orb-2,
        .orb-3 {
            position: fixed;
            border-radius: 50%;
            z-index: 1;
        }
        body::after {
            content: '';
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(218, 165, 32, 0.08) 0%, transparent 70%);
            top: -400px;
            right: -400px;
            animation: floatOrb1 25s ease-in-out infinite;
        }
        .orb-2 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.06) 0%, transparent 70%);
            bottom: -300px;
            left: -300px;
            animation: floatOrb2 30s ease-in-out infinite;
        }
        .orb-3 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(184, 134, 11, 0.05) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: floatOrb3 20s ease-in-out infinite;
        }

        @keyframes floatOrb1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-100px, 100px) scale(1.1); }
            66% { transform: translate(50px, -50px) scale(0.9); }
        }
        @keyframes floatOrb2 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(100px, -100px) rotate(180deg); }
        }
        @keyframes floatOrb3 {
            0%, 100% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-30%, -70%) scale(1.2); }
        }

        /* Golden Particles */
        .particles {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }
        .particle {
            position: absolute;
            background: rgba(218, 165, 32, 0.6);
            border-radius: 50%;
            pointer-events: none;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
        }
        .particle:nth-child(1) { width: 3px; height: 3px; left: 15%; animation: float-particle 12s infinite; animation-delay: 0s; }
        .particle:nth-child(2) { width: 5px; height: 5px; left: 85%; animation: float-particle 15s infinite; animation-delay: 3s; }
        .particle:nth-child(3) { width: 4px; height: 4px; left: 45%; animation: float-particle 18s infinite; animation-delay: 6s; }
        .particle:nth-child(4) { width: 6px; height: 6px; left: 65%; animation: float-particle 20s infinite; animation-delay: 9s; }
        .particle:nth-child(5) { width: 3px; height: 3px; left: 25%; animation: float-particle 14s infinite; animation-delay: 2s; }
        .particle:nth-child(6) { width: 5px; height: 5px; left: 75%; animation: float-particle 16s infinite; animation-delay: 5s; }

        @keyframes float-particle {
            0%   { transform: translateY(100vh) scale(0); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 1; }
            100% { transform: translateY(-100vh) scale(1); opacity: 0; }
        }

        .container {
            position: relative;
            z-index: 10;
        }

        .brand-section {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInDown 0.8s ease;
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .brand-logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 50%, #B8860B 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 50px rgba(218, 165, 32, 0.5), 0 0 80px rgba(255, 215, 0, 0.3);
            position: relative;
            animation: logoGlow 3s ease-in-out infinite;
        }
        @keyframes logoGlow {
            0%, 100% { 
                box-shadow: 0 15px 50px rgba(218, 165, 32, 0.5), 0 0 80px rgba(255, 215, 0, 0.3);
                transform: scale(1);
            }
            50% { 
                box-shadow: 0 15px 60px rgba(218, 165, 32, 0.7), 0 0 100px rgba(255, 215, 0, 0.4);
                transform: scale(1.03);
            }
        }
        .brand-logo::before {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, #DAA520, #FFD700, #DAA520, #FFD700);
            background-size: 300% 300%;
            border-radius: 24px;
            z-index: -1;
            opacity: 0.4;
            animation: borderRotate 4s linear infinite;
        }
        @keyframes borderRotate {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .brand-logo::after {
            content: '';
            position: absolute;
            inset: -6px;
            background: linear-gradient(45deg, transparent 30%, rgba(218, 165, 32, 0.2) 50%, transparent 70%);
            border-radius: 24px;
            z-index: -2;
            animation: shine 3s ease-in-out infinite;
        }
        @keyframes shine {
            0%, 100% { transform: rotate(0deg); opacity: 0; }
            50%      { transform: rotate(180deg); opacity: 1; }
        }

        .brand-title {
            font-size: 2.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, #FFD700 0%, #DAA520 30%, #FFF8DC 60%, #FFD700 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.75rem;
            letter-spacing: 1px;
            animation: textShimmer 3s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(218, 165, 32, 0.3);
        }
        @keyframes textShimmer {
            0%, 100% { background-position: 0% 50%; }
            50%      { background-position: 100% 50%; }
        }
        .brand-title i {
            display: inline-block;
            animation: iconRotate 4s ease-in-out infinite;
        }
        @keyframes iconRotate {
            0%, 100% { transform: rotate(0deg); }
            25%      { transform: rotate(-10deg); }
            75%      { transform: rotate(10deg); }
        }

        .brand-subtitle {
            font-size: 1.1rem;
            color: rgba(218, 165, 32, 0.8);
            font-weight: 400;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .content-wrapper {
            max-width: 520px;
            margin: 0 auto;
            width: 100%;
        }

        .footer-section {
            text-align: center;
            margin-top: 2.5rem;
            color: rgba(218, 165, 32, 0.6);
            animation: fadeIn 1s ease 0.6s both;
            font-size: 0.95rem;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .footer-section p {
            margin: 0;
        }
        .footer-section .heart {
            color: #DAA520;
            display: inline-block;
            animation: heartbeat 1.5s ease infinite;
        }
        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            25%      { transform: scale(1.2); }
            50%      { transform: scale(1); }
        }

        /* Scanline Effect */
        .scanline {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.3), transparent);
            animation: scanline 4s linear infinite;
            z-index: 5;
            pointer-events: none;
        }
        @keyframes scanline {
            0%  { transform: translateY(0); opacity: 0; }
            50% { opacity: 1; }
            100%{ transform: translateY(100vh); opacity: 0; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .brand-title { font-size: 2rem; }
            .brand-logo { width: 80px; height: 80px; }
            .brand-logo i { font-size: 2rem !important; }
            .content-wrapper { padding: 0 1rem; }
            .brand-subtitle { font-size: 0.95rem; }
        }
        @media (max-width: 576px) {
            .brand-section { margin-bottom: 2rem; }
            .footer-section { margin-top: 2rem; font-size: 0.85rem; }
        }
    </style>
</head>
<body>
    <div class="orb-2"></div>
    <div class="orb-3"></div>
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    <div class="scanline"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                {{-- Only show brand section on homepage --}}
                @if (request()->routeIs('welcome'))
                <div class="brand-section">
                    <div class="brand-logo">
                        <i class="bi bi-camera-fill text-dark" style="font-size: 2.8rem;"></i>
                    </div>
                    <h1 class="brand-title">
                        <i class="bi bi-camera"></i> GaleriKu
                    </h1>
                    <p class="brand-subtitle">Berbagi Momen Indah, Abadikan Kenangan</p>
                </div>
                @endif

                <div class="content-wrapper">
                    @yield('content')
                </div>

                @if (request()->routeIs('welcome'))
                <div class="footer-section">
                    <p>
                        © {{ date('Y') }} GaleriKu. Dibuat dengan 
                        <i class="bi bi-heart-fill heart"></i> 
                        untuk pecinta fotografi
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>