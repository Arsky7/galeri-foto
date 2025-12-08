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
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            box-shadow: 0 10px 40px rgba(0,0,0,.2);
            border: none;
            border-radius: 15px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                
                <!-- Logo & Brand -->
                <div class="text-center mb-4">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-camera-fill text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h1 class="text-white fw-bold mb-2">GaleriKu</h1>
                    <p class="text-white-50">Berbagi Momen Indahmu</p>
                </div>
                
                <!-- Card Content -->
                <div class="card auth-card">
                    <div class="card-body p-4">
                        
                        @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                        </div>
                        @endif
                        
                        @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                        </div>
                        @endif
                        
                        @yield('content')
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="text-center mt-4">
                    <p class="text-white-50 small">
                        © 2024 GaleriKu. Made with <i class="bi bi-heart-fill text-danger"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>