@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-user me-2"></i>Selamat datang, {{ auth()->user()->name }}!
                    </div>
                    
                    @if(count($cart) > 0)
                        @foreach($cart as $id => $item)
                        <div class="row align-items-center mb-3 p-3 border rounded">
                            <div class="col-md-2">
                                <div class="bg-light rounded p-2 text-center">
                                    <i class="fas fa-utensils" style="font-size: 2rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="mb-1">{{ $item['nama'] }}</h6>
                                <small class="text-muted" style="color: #ffe066 !important;">Makanan Utama</small>
                            </div>
                            <div class="col-md-2">
                                <span class="price-tag">Rp{{ number_format($item['harga'], 0, ',', '.') }}</span>
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    <button type="submit" name="qty" value="{{ $item['qty'] - 1 }}" class="btn btn-outline-secondary btn-sm" {{ $item['qty'] <= 1 ? 'disabled' : '' }}>-</button>
                                    <input type="text" name="qty" value="{{ $item['qty'] }}" class="form-control text-center mx-1" style="width: 40px;" readonly>
                                    <button type="submit" name="qty" value="{{ $item['qty'] + 1 }}" class="btn btn-outline-secondary btn-sm">+</button>
                                </form>
                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <span class="fw-bold me-2">Rp{{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</span>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini dari keranjang?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger ms-2"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart mb-3" style="font-size: 4rem; color: #ccc;"></i>
                            <h5 class="text-muted" style="color: #ffe066 !important;">Keranjang Belanja Kosong</h5>
                            <p class="text-muted" style="color: #ffe066 !important;">Belum ada makanan yang ditambahkan ke keranjang</p>
                            <a href="{{ route('foods.index') }}" class="btn btn-primary">
                                <i class="fas fa-utensils me-2"></i>Pesan Makanan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mt-4 mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    @if(count($cart) > 0)
                        @php $total = 0; @endphp
                        @foreach($cart as $item)
                            @php $subtotal = $item['harga'] * $item['qty']; $total += $subtotal; @endphp
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $item['nama'] }} x{{ $item['qty'] }}</span>
                                <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <!-- Promo Code Section -->
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="promoCode" placeholder="Masukkan kode promo" style="color: #ffe066; background: #222; border-color: #ffe066;">
                                <button class="btn btn-outline-primary" type="button" onclick="applyPromo()">
                                    <i class="fas fa-tag me-1"></i>Apply
                                </button>
                            </div>
                            <small class="text-muted" style="color: #ffe066 !important;">Contoh: WELCOME10, FREESHIP, HAPPY20</small>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ongkos Kirim</span>
                            <span id="shippingCost">Rp5.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" id="discountRow" style="display: none;">
                            <span>Diskon</span>
                            <span id="discountAmount" class="text-success">-Rp0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total</strong>
                            <strong class="text-success" id="totalAmount">Rp{{ number_format($total + 5000, 0, ',', '.') }}</strong>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-success w-100">
                            <i class="fas fa-credit-card me-2"></i>Checkout Sekarang
                        </a>
                    @else
                        <p class="text-muted text-center" style="color: #ffe066 !important;">Keranjang kosong</p>
                    @endif
                </div>
            </div>
            
            <!-- Delivery Info -->
            <div class="card mt-3 mb-4">
                <div class="card-body">
                    <h6><i class="fas fa-truck me-2"></i>Informasi Pengiriman</h6>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-clock text-primary me-2"></i>
                        <span>Estimasi: 30-45 menit</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                        <span>Jarak: 2-5 km</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt text-success me-2"></i>
                        <span>Pembayaran Aman</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function applyPromo() {
    const promoCode = document.getElementById('promoCode').value;
    if (!promoCode) {
        alert('Masukkan kode promo!');
        return;
    }
    
    // Simulasi validasi promo (dalam implementasi nyata, ini akan call API)
    const promos = {
        'WELCOME10': { type: 'percentage', value: 10, minOrder: 50000 },
        'FREESHIP': { type: 'fixed', value: 5000, minOrder: 100000 },
        'HAPPY20': { type: 'percentage', value: 20, minOrder: 75000 }
    };
    
    const promo = promos[promoCode.toUpperCase()];
    if (!promo) {
        alert('Kode promo tidak valid!');
        return;
    }
    
    // Hitung total dari cart
    const cartItems = @json($cart);
    let subtotal = 0;
    for (let item in cartItems) {
        subtotal += cartItems[item].harga * cartItems[item].qty;
    }
    
    if (subtotal < promo.minOrder) {
        alert(`Minimal order Rp${promo.minOrder.toLocaleString()} untuk kode ini!`);
        return;
    }
    
    // Hitung diskon
    let discount = 0;
    if (promo.type === 'percentage') {
        discount = (subtotal * promo.value) / 100;
    } else {
        discount = promo.value;
    }
    
    // Update tampilan
    document.getElementById('discountRow').style.display = 'flex';
    document.getElementById('discountAmount').textContent = `-Rp${discount.toLocaleString()}`;
    
    const shippingCost = promoCode.toUpperCase() === 'FREESHIP' ? 0 : 5000;
    document.getElementById('shippingCost').textContent = shippingCost === 0 ? 'Gratis' : `Rp${shippingCost.toLocaleString()}`;
    
    const total = subtotal + shippingCost - discount;
    document.getElementById('totalAmount').textContent = `Rp${total.toLocaleString()}`;
    
    alert(`Promo berhasil diterapkan! Diskon: Rp${discount.toLocaleString()}`);
}
</script>

<style>
/* Tabel dan border cart sesuai tema */
.table, .table-bordered, .table td, .table th {
    color: #ffe066 !important;
    border-color: #ffe066 !important;
    background: rgba(20, 24, 48, 0.7) !important;
}
.price-tag, .fw-bold, .text-success, .form-control, .input-group-text {
    color: #ffe066 !important;
}
.input-group .form-control {
    background: #222 !important;
    color: #ffe066 !important;
    border-color: #ffe066 !important;
}
.input-group .btn {
    border-color: #ffe066 !important;
    color: #ffe066 !important;
}
.card, .card-header, .card-body {
    background: rgba(20, 24, 48, 0.7) !important;
    color: #ffe066 !important;
}
</style>
@endsection 