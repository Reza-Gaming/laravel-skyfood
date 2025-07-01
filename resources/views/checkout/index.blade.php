@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mt-4 mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>Informasi Pemesanan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_pemesan" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nama Lengkap
                                </label>
                                <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telepon" class="form-label">
                                    <i class="fas fa-phone me-2"></i>Nomor Telepon
                                </label>
                                <input type="tel" class="form-control" id="telepon" name="telepon" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat Lengkap
                            </label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kota" class="form-label">
                                    <i class="fas fa-city me-2"></i>Kota
                                </label>
                                <input type="text" class="form-control" id="kota" name="kota" value="Jakarta" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kode_pos" class="form-label">
                                    <i class="fas fa-mail-bulk me-2"></i>Kode Pos
                                </label>
                                <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">
                                <i class="fas fa-sticky-note me-2"></i>Catatan (Opsional)
                            </label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="2" placeholder="Contoh: Tidak pedas, tambah sambal, dll."></textarea>
                        </div>
                        
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6><i class="fas fa-credit-card me-2"></i>Pembayaran</h6>
                                <div class="mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="simulasi" value="simulasi" checked>
                                        <label class="form-check-label" for="simulasi">
                                            Transfer/Virtual Account
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="offline" value="offline">
                                        <label class="form-check-label" for="offline">
                                            Bayar Langsung di Tempat (COD/Offline)
                                        </label>
                                    </div>
                                </div>
                                <div class="alert alert-info mb-0">
                                    Pilih metode pembayaran yang diinginkan. Untuk simulasi, klik "Bayar Sekarang" setelah checkout.
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-lg w-100 mt-3">
                            <i class="fas fa-check-circle me-2"></i>Buat Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mt-4 mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    @foreach($cart as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item['nama'] }} x{{ $item['qty'] }}</span>
                        <span>Rp{{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Ongkos Kirim</span>
                        <span>Rp5.000</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong class="text-success">Rp{{ number_format($total + 5000, 0, ',', '.') }}</strong>
                    </div>
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
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-shield-alt text-success me-2"></i>
                        <span>Pembayaran Aman</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-headset text-info me-2"></i>
                        <span>24/7 Customer Support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table, .table-bordered, .table td, .table th {
    color: #ffe066 !important;
    border-color: #ffe066 !important;
    background: rgba(20, 24, 48, 0.7) !important;
}
.card, .card-header, .card-body {
    background: rgba(20, 24, 48, 0.7) !important;
    color: #ffe066 !important;
}
.form-label, .form-control, .input-group-text {
    color: #ffe066 !important;
}
.form-control {
    background: #222 !important;
    color: #ffe066 !important;
    border-color: #ffe066 !important;
}
.btn, .btn-success, .btn-primary {
    color: #232946 !important;
}
.text-success, .fw-bold, strong {
    color: #ffe066 !important;
}
</style>
@endsection 