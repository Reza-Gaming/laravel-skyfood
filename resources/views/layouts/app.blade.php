<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyfood - Pesan Makanan Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a1a40; /* deep night blue */
            --secondary-color: #232946; /* blue-black */
            --accent-color: #ffe066; /* soft yellow */
            --star-color: #fffbe7; /* star color */
            --purple-glow: #6c63ff;
            --dark-color: #121629; /* night dark */
            --light-color: #eebbc3; /* soft pink accent */
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(ellipse at 70% 20%, #232946 0%, #1a1a40 60%, #121629 100%);
            min-height: 100vh;
            color: #f4f4f4;
            position: relative;
        }
        
        /* Starry sky background */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 0;
            pointer-events: none;
            background: transparent;
        }
        
        .star {
            position: absolute;
            background: var(--star-color);
            border-radius: 50%;
            opacity: 0.8;
            animation: twinkle 2.5s infinite linear;
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 0.2; }
        }
        
        .navbar {
            background: linear-gradient(90deg, #232946 60%, #1a1a40 100%);
            box-shadow: 0 2px 20px 0 #6c63ff44;
            border-bottom: 2px solid var(--purple-glow);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.7rem;
            color: var(--accent-color) !important;
            letter-spacing: 1px;
            text-shadow: 0 0 8px #ffe06699, 0 0 2px #fff;
        }
        
        .nav-link {
            color: #f4f4f4 !important;
            font-weight: 500;
            transition: all 0.3s ease;
            text-shadow: 0 0 4px #232946;
        }
        
        .nav-link:hover {
            color: var(--accent-color) !important;
            transform: translateY(-2px) scale(1.05);
            text-shadow: 0 0 8px #ffe06699;
        }
        
        .cart-badge {
            background-color: var(--accent-color);
            color: #232946;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #232946 60%, #6c63ff 100%);
            color: var(--accent-color);
            padding: 4rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 0 40px 0 #6c63ff33;
        }
        
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 #23294699, 0 0 0 2px #6c63ff22;
            background: #232946cc;
            color: #f4f4f4;
            backdrop-filter: blur(2px);
        }
        
        .card-header {
            background: #232946;
            color: var(--accent-color) !important;
            border-bottom: 1px solid #6c63ff;
            font-weight: bold;
            font-size: 1.2rem;
            letter-spacing: 1px;
            text-shadow: 0 0 8px #ffe06699;
        }
        
        .table {
            background: #232946;
            color: #f4f4f4;
        }
        
        .table th, .table td {
            background: #232946;
            color: #f4f4f4;
        }
        
        .table-light th {
            background: #232946 !important;
            color: var(--accent-color) !important;
        }
        
        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #232946;
            box-shadow: 0 0 8px #ffe06655;
        }
        
        .btn-primary:hover {
            background-color: #fffbe7;
            border-color: #fffbe7;
            color: #232946;
            box-shadow: 0 0 16px #ffe06699;
        }
        
        .btn-success {
            background-color: #6c63ff;
            border-color: #6c63ff;
            color: #fff;
            box-shadow: 0 0 8px #6c63ff55;
        }
        
        .btn-success:hover {
            background-color: #4b47b5;
            border-color: #4b47b5;
        }
        
        .btn-outline-primary {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }
        
        .btn-outline-primary:hover {
            background: var(--accent-color);
            color: #232946;
        }
        
        .btn-outline-danger {
            border-color: #ff6b6b;
            color: #ff6b6b;
        }
        
        .btn-outline-danger:hover {
            background: #ff6b6b;
            color: #232946;
        }
        
        .price-tag {
            background-color: var(--accent-color);
            color: #232946;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            box-shadow: 0 0 8px #ffe06655;
        }
        
        .category-badge {
            background-color: #6c63ff;
            color: #fff;
        }
        
        .footer {
            background-color: #1a1a40;
            color: #f4f4f4;
            border-top: 2px solid #6c63ff;
            box-shadow: 0 -2px 20px 0 #6c63ff44;
        }
        
        .badge.bg-success, .badge.bg-danger, .badge.bg-warning, .badge.bg-info, .badge.bg-primary {
            color: #232946 !important;
            font-weight: 600;
            text-shadow: 0 0 4px #fffbe7;
        }
        
        .badge.bg-success { background: #ffe066 !important; color: #232946 !important; }
        .badge.bg-danger { background: #ff6b6b !important; color: #fff !important; }
        .badge.bg-warning { background: #fffbe7 !important; color: #232946 !important; }
        .badge.bg-info { background: #6c63ff !important; color: #fff !important; }
        .badge.bg-primary { background: #a7a9be !important; color: #232946 !important; }
        .badge.bg-secondary { background: #232946 !important; color: #ffe066 !important; }
        
        /* Glow effect for main titles */
        h1, h2, h3, h4, h5, h6 {
            text-shadow: 0 0 8px #6c63ff55, 0 0 2px #fffbe7;
        }
        
        /* Glow for card on hover */
        .card:hover {
            box-shadow: 0 0 32px 0 #6c63ff99, 0 0 0 2px #ffe06655;
        }
        
        /* Form controls */
        .form-control, .form-select {
            background: #232946;
            color: #f4f4f4;
            border: 1px solid #6c63ff;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem #ffe06655;
        }
        
        /* Starry sky effect */
        #star-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: 0;
            pointer-events: none;
        }
        
        /* Pastikan semua teks cukup kontras */
        h1, h2, h3, h4, h5, h6, .fw-bold, .navbar, .nav-link, .card, .card-header, .table, .footer, .btn, .badge, .form-label, .form-control, .form-select {
            text-shadow: 0 1px 2px rgba(0,0,0,0.15);
        }
        
        /* Scrollbar gelap */
        ::-webkit-scrollbar {
            width: 10px;
            background: var(--primary-color);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--dark-color);
            border-radius: 5px;
        }
        
        .toast {
            background: rgba(20,24,48,0.95) !important;
            border: 2px solid #ffe066 !important;
            box-shadow: 0 0 16px #ffe06655, 0 2px 12px #23294699;
            color: #ffe066 !important;
            border-radius: 14px !important;
            backdrop-filter: blur(2px);
        }
        .toast-header.bg-success, .toast-header.bg-danger {
            background: linear-gradient(90deg, #232946 60%, #1a1a40 100%) !important;
            color: #ffe066 !important;
            border-bottom: 1px solid #ffe066 !important;
            text-shadow: 0 0 8px #ffe06699;
        }
        .toast-body {
            color: #ffe066 !important;
            text-shadow: 0 1px 4px #232946, 0 0 2px #000;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/foods">
                <i class="fas fa-utensils me-2"></i>Skyfood
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/foods">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="/cart">
                            <i class="fas fa-shopping-cart me-1"></i>Keranjang
                            @if(session('cart'))
                                <span class="cart-badge">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                    </li>
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog me-1"></i>Admin
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.users') }}">
                                        <i class="fas fa-users me-2"></i>Kelola User
                                    </a></li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-user me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}">
                                    <i class="fas fa-list me-1"></i>Pesanan
                                </a>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-user me-2"></i>Profil
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-utensils me-2"></i>Skyfood</h5>
                    <p>Platform pemesanan makanan online terpercaya dengan berbagai pilihan menu favorit Anda.</p>
                </div>
                <div class="col-md-4">
                    <h5>Layanan</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-arrow-right me-2"></i>Pesan Makanan</li>
                        <li><i class="fas fa-arrow-right me-2"></i>Pengiriman Cepat</li>
                        <li><i class="fas fa-arrow-right me-2"></i>Pembayaran Aman</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-envelope me-2"></i>info@skyfood.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center">
                <p>&copy; 2024 Skyfood. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Toast Notification System -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        @if(session('success'))
        <div class="toast show" role="alert">
            <div class="toast-header bg-success text-white">
                <i class="fas fa-check-circle me-2"></i>
                <strong class="me-auto">Sukses!</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
        @endif
        
        @if(session('error'))
        <div class="toast show" role="alert">
            <div class="toast-header bg-danger text-white">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong class="me-auto">Error!</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
        @endif
    </div>
    
    <script>
        // Auto hide toasts after 5 seconds
        setTimeout(function() {
            var toasts = document.querySelectorAll('.toast');
            toasts.forEach(function(toast) {
                var bsToast = new bootstrap.Toast(toast);
                bsToast.hide();
            });
        }, 5000);

        // Generate random stars for starry sky
        document.addEventListener('DOMContentLoaded', function() {
            var starBg = document.createElement('div');
            starBg.id = 'star-bg';
            document.body.appendChild(starBg);
            for(let i=0; i<160; i++) {
                let star = document.createElement('div');
                star.className = 'star';
                let size = Math.random() * 2.2 + 1.2;
                star.style.width = size + 'px';
                star.style.height = size + 'px';
                star.style.top = (Math.random() * 100) + 'vh';
                star.style.left = (Math.random() * 100) + 'vw';
                star.style.opacity = Math.random() * 0.7 + 0.3;
                star.style.animationDelay = (Math.random() * 2) + 's';
                starBg.appendChild(star);
            }
        });
    </script>
</body>
</html> 