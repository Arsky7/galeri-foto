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
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 50%, #2c3e50 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Animated Background Elements */
        body::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(52, 152, 219, 0.3) 0%, transparent 70%);
            border-radius: 50%;
            top: -300px;
            left: -200px;
            animation: float1 20s ease-in-out infinite;
        }
        
        body::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(44, 62, 80, 0.4) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -250px;
            right: -150px;
            animation: float2 18s ease-in-out infinite;
        }
        
        @keyframes float1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(100px, 100px) scale(1.1); }
        }
        
        @keyframes float2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-80px, -80px) scale(1.15); }
        }
        
        .container {
            position: relative;
            z-index: 10;
        }
        
        .brand-section {
            text-align: center;
            margin-bottom: 2.5rem;
            animation: fadeInDown 1s ease;
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .brand-logo {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.5rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            animation: pulse 2s ease infinite;
        }
        
        @keyframes pulse {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            }
            50% { 
                transform: scale(1.05);
                box-shadow: 0 20px 50px rgba(52, 152, 219, 0.4);
            }
        }
        
        .brand-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
        }
        
        .brand-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 400;
        }
        
        .content-wrapper {
            max-width: 520px;
            margin: 0 auto;
            width: 100%;
        }
        
        .footer-section {
            text-align: center;
            margin-top: 2rem;
            color: rgba(255, 255, 255, 0.7);
            animation: fadeIn 1s ease 0.5s both;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .footer-section p {
            margin: 0;
            font-size: 0.95rem;
        }
        
        .footer-section .heart {
            color: #e74c3c;
            animation: heartbeat 1.5s ease infinite;
        }
        
        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.2); }
            50% { transform: scale(1); }
        }
        
        /* Floating Particles */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            pointer-events: none;
            animation: float-particle 15s infinite;
        }
        
        @keyframes float-particle {
            0%, 100% {
                transform: translate(0, 0);
                opacity: 0;
            }
            10%, 90% {
                opacity: 1;
            }
            50% {
                transform: translate(100px, -200px);
            }
        }
        
        .particle:nth-child(1) {
            width: 10px;
            height: 10px;
            left: 10%;
            top: 80%;
            animation-delay: 0s;
        }
        
        .particle:nth-child(2) {
            width: 15px;
            height: 15px;
            left: 80%;
            top: 20%;
            animation-delay: 3s;
        }
        
        .particle:nth-child(3) {
            width: 8px;
            height: 8px;
            left: 50%;
            top: 50%;
            animation-delay: 6s;
        }
        
        .particle:nth-child(4) {
            width: 12px;
            height: 12px;
            left: 30%;
            top: 30%;
            animation-delay: 9s;
        }
        
        .particle:nth-child(5) {
            width: 20px;
            height: 20px;
            left: 70%;
            top: 70%;
            animation-delay: 12s;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .brand-title {
                font-size: 2rem;
            }
            
            .brand-logo {
                width: 75px;
                height: 75px;
            }
            
            .content-wrapper {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>
    
    <!-- Floating Particles -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                
                <!-- Brand Section -->
                <div class="brand-section">
                    <div class="brand-logo">
                        <i class="bi bi-camera-fill text-white" style="font-size: 2.5rem;"></i>
                    </div>
                    <h1 class="brand-title">
                        <i class="bi bi-camera"></i> GaleriKu
                    </h1>
                    <p class="brand-subtitle">Berbagi Momen Indah, Abadikan Kenangan</p>
                </div>
                
                <!-- Content Wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                
                <!-- Footer -->
                <div class="footer-section">
                    <p>
                        © 2024 GaleriKu. Dibuat dengan 
                        <i class="bi bi-heart-fill heart"></i> 
                        untuk pecinta fotografi
                    </p>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>