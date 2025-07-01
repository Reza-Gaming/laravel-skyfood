@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-3">Pesan Makanan Favorit Anda</h1>
                <p class="lead mb-4">Nikmati berbagai pilihan menu lezat dengan pengiriman cepat dan aman. Pesan sekarang, makan enak!</p>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-clock me-2"></i>
                    <span>Pengiriman 30-45 menit</span>
                </div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Login untuk Pesan
                    </a>
                @endguest
            </div>
            <div class="col-md-6 text-center">
                <i class="fas fa-utensils" style="font-size: 8rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <style>
        .search-filter-dark input.form-control,
        .search-filter-dark select.form-select {
            background: #232946;
            color: #fff !important;
            border: 1px solid #6c63ff;
        }
        .search-filter-dark input.form-control::placeholder {
            color: #ffe066 !important;
            opacity: 1;
        }
        .search-filter-dark select.form-select option {
            color: #232946;
            background: #ffe066;
        }
    </style>
    <!-- Search & Filter Section -->
    <div class="card mb-4 search-filter-dark" style="background: #232946cc; box-shadow: 0 0 16px #6c63ff44;">
        <div class="card-body">
            <form method="GET" action="{{ route('foods.index') }}" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Cari makanan..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="min_price" placeholder="Min Harga" value="{{ request('min_price') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="max_price" placeholder="Max Harga" value="{{ request('max_price') }}">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="sort">
                        <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Urutkan Nama</option>
                        <option value="harga" {{ request('sort') == 'harga' ? 'selected' : '' }}>Urutkan Harga</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="order">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>A-Z</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Z-A</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <a href="{{ route('foods.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="mb-4">
        <h3 class="mb-3"><i class="fas fa-tags me-2"></i>Kategori Makanan</h3>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3 bg-transparent border-0">
                    <i class="fas fa-hamburger mb-2" style="font-size: 2rem; color: #ffe066;"></i>
                    <h6 style="color: #fff;">Makanan Utama</h6>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3 bg-transparent border-0">
                    <i class="fas fa-coffee mb-2" style="font-size: 2rem; color: #6c63ff;"></i>
                    <h6 style="color: #fff;">Minuman</h6>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3 bg-transparent border-0">
                    <i class="fas fa-ice-cream mb-2" style="font-size: 2rem; color: #fffbe7;"></i>
                    <h6 style="color: #fff;">Dessert</h6>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3 bg-transparent border-0">
                    <i class="fas fa-pizza-slice mb-2" style="font-size: 2rem; color: #3e92cc;"></i>
                    <h6 style="color: #fff;">Snack</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="mb-4">
        <h3 class="mb-3"><i class="fas fa-utensils me-2"></i>Menu Favorit</h3>
        <div class="row">
            @foreach($foods as $food)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    @if($food->gambar)
                        @if(filter_var($food->gambar, FILTER_VALIDATE_URL))
                            <img src="{{ $food->gambar }}" class="card-img-top" alt="{{ $food->nama }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('storage/' . $food->gambar) }}" class="card-img-top" alt="{{ $food->nama }}" style="height: 200px; object-fit: cover;">
                        @endif
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px; background: #232946;">
                            <i class="fas fa-utensils" style="font-size: 3rem; color: #ffe066;"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="category-badge">Makanan Utama</span>
                        </div>
                        <h5 class="card-title" style="color: #ffe066;">{{ $food->nama }}</h5>
                        <p class="card-text" style="color: #ffe066;">{{ $food->deskripsi }}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="price-tag" style="color: #232946; background: #ffe066;">Rp{{ number_format($food->harga, 0, ',', '.') }}</span>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star text-warning me-1"></i>
                                    <span class="text-muted" style="color: #fffbe7;">{{ number_format($food->average_rating, 1) }} ({{ $food->reviews_count }})</span>
                                </div>
                            </div>
                            <form action="{{ route('foods.addToCart', $food->id) }}" method="POST" class="mb-2">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-plus me-2"></i>Tambah ke Keranjang
                                </button>
                            </form>
                            @auth
                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $food->id }}">
                                    <i class="fas fa-star me-2"></i>Berikan Review
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login untuk Review
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-5">
        <div class="col-md-4 text-center mb-4">
            <div class="p-4">
                <i class="fas fa-shipping-fast mb-3" style="font-size: 3rem; color: #fff;"></i>
                <h5 style="color: #fff;">Pengiriman Cepat</h5>
                <p class="text-muted" style="color: #ffe066 !important;">Makanan sampai dalam 30-45 menit</p>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="p-4">
                <i class="fas fa-shield-alt mb-3" style="font-size: 3rem; color: #fff;"></i>
                <h5 style="color: #fff;">Pembayaran Aman</h5>
                <p class="text-muted" style="color: #ffe066 !important;">Transaksi aman dan terpercaya</p>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="p-4">
                <i class="fas fa-heart mb-3" style="font-size: 3rem; color: #fff;"></i>
                <h5 style="color: #fff;">Kualitas Terjamin</h5>
                <p class="text-muted" style="color: #ffe066 !important;">Makanan segar dan berkualitas</p>
            </div>
        </div>
    </div>
</div>

<!-- Review Modals -->
@foreach($foods as $food)
<div class="modal fade" id="reviewModal{{ $food->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review {{ $food->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="food_id" value="{{ $food->id }}">
                    <div class="mb-3">
                        <label class="form-label">Nama Anda</label>
                        <input type="text" class="form-control" name="nama_reviewer" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div class="d-flex">
                            @for($i = 1; $i <= 5; $i++)
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="rating" value="{{ $i }}" id="rating{{ $food->id }}{{ $i }}" required>
                                <label class="form-check-label" for="rating{{ $food->id }}{{ $i }}">
                                    <i class="fas fa-star text-warning"></i> {{ $i }}
                                </label>
                            </div>
                            @endfor
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Komentar (Opsional)</label>
                        <textarea class="form-control" name="komentar" rows="3" placeholder="Bagaimana pengalaman Anda dengan makanan ini?"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection 