@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="fas fa-user me-2"></i>Dashboard User</h2>
            <p class="text-muted">Selamat datang, {{ $user->name }}!</p>
        </div>
    </div>

    <!-- User Stats -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalOrders }}</h4>
                            <p class="mb-0">Total Pesanan</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-shopping-bag fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">Rp{{ number_format($totalSpent, 0, ',', '.') }}</h4>
                            <p class="mb-0">Total Pengeluaran</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $user->created_at->diffForHumans() }}</h4>
                            <p class="mb-0">Member Sejak</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card" style="color: #ffe066;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('foods.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-utensils me-2"></i>Pesan Makanan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Keranjang
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-list me-2"></i>Riwayat Pesanan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Orders -->
        <div class="col-md-8 mb-4">
            <div class="card" style="background: rgba(20,24,48,0.95); color: #ffe066; border: 2px solid #ffe066; box-shadow: 0 0 16px #ffe06655;">
                <div class="card-header" style="background: transparent; color: #ffe066; border-bottom: 2px solid #ffe066;">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    @if(count($recentOrders) > 0)
                        @foreach($recentOrders as $order)
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded" style="border: 2px solid #ffe066 !important; background: rgba(26,26,64,0.7); color: #ffe066;">
                            <div>
                                <strong>#{{ $order->id }}</strong>
                                <br>
                                <small class="text-muted" style="color: #ffe06699 !important;">{{ $order->tracking_number ?? 'No Tracking' }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'delivered' ? 'success' : 'info') }}" style="background: #ffe066 !important; color: #232946 !important; font-weight: bold; border-radius: 8px; font-size: 1rem;">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <br>
                                <small class="text-muted" style="color: #ffe06699 !important;">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</small>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-shopping-bag mb-2" style="font-size: 3rem; color: #ffe06699;"></i>
                            <p class="text-muted" style="color: #ffe06699 !important;">Belum ada pesanan</p>
                            <a href="{{ route('foods.index') }}" class="btn btn-primary" style="background: linear-gradient(90deg, #ffe066 60%, #fffbe7 100%); color: #232946; border: none; font-weight: bold; border-radius: 12px; box-shadow: 0 0 8px #ffe06699;">
                                <i class="fas fa-utensils me-2"></i>Pesan Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- User Info -->
        <div class="col-md-4 mb-4">
            <div class="card" style="color: #ffe066;">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Informasi Akun</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h5>{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->email }}</p>
                        <span class="badge bg-secondary">{{ ucfirst($user->role) }}</span>
                    </div>
                    
                    <hr>
                    
                    <div class="mb-2">
                        <small class="text-muted">ID User:</small><br>
                        <strong>{{ $user->id }}</strong>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Bergabung:</small><br>
                        <strong>{{ $user->created_at->format('d M Y') }}</strong>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Total Pesanan:</small><br>
                        <strong>{{ $totalOrders }} pesanan</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-lg {
    width: 80px;
    height: 80px;
    font-size: 2rem;
    font-weight: bold;
}
.card, .card-header, .card-body, .card .text-end, .card .text-center, .card .text-muted, .card h2, .card h4, .card h5, .card p, .card small, .card strong {
    color: #ffe066 !important;
}
.bg-primary, .bg-success, .bg-info, .bg-warning, .bg-secondary {
    background: rgba(20,24,48,0.95) !important;
    color: #ffe066 !important;
    border: 2px solid #ffe066 !important;
    box-shadow: 0 0 16px #ffe06655;
}
</style>
@endsection 