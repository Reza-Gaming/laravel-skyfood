@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mt-4 mb-3"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</h2>
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
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-users me-2"></i>Kelola User
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('admin.foods.index') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-utensils me-2"></i>Kelola Menu
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-list me-2"></i>Lihat Pesanan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('foods.index') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-star me-2"></i>Kelola Review
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalOrders }}</h4>
                            <p class="mb-0">Total Pesanan</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                            <p class="mb-0">Total Pendapatan</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalFoods }}</h4>
                            <p class="mb-0">Menu Tersedia</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-utensils fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalReviews }}</h4>
                            <p class="mb-0">Total Review</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-star fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalUsers }}</h4>
                            <p class="mb-0">Total User</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Orders -->
        <div class="col-md-6 mb-4">
            <div class="card" style="color: #ffe066;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    @if(count($recentOrders) > 0)
                        @foreach($recentOrders as $order)
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                            <div>
                                <strong>#{{ $order->id }}</strong>
                                <br>
                                <small class="text-muted">{{ $order->nama_pemesan }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'delivered' ? 'success' : 'info') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <br>
                                <small class="text-muted">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</small>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center">Belum ada pesanan</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Top Foods -->
        <div class="col-md-6 mb-4">
            <div class="card" style="color: #ffe066;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>Menu Terpopuler</h5>
                </div>
                <div class="card-body">
                    @if(count($topFoods) > 0)
                        @foreach($topFoods as $food)
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                            <div>
                                <strong>{{ $food->nama }}</strong>
                                <br>
                                <small class="text-muted">{{ $food->reviews_count }} reviews</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary">{{ number_format($food->average_rating, 1) }} ⭐</span>
                                <br>
                                <small class="text-muted">Rp{{ number_format($food->harga, 0, ',', '.') }}</small>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center">Belum ada data</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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