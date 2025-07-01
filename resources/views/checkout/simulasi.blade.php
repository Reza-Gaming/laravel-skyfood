@extends('layouts.app')

@section('title', 'Simulasi Pembayaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow" style="background: rgba(20,24,48,0.9); color: #ffe066;">
                <div class="card-body text-center">
                    <h3 class="mb-4" style="color: #ffe066;">Simulasi Pembayaran</h3>
                    <form action="{{ route('checkout.simulasi.proses') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button type="submit" class="btn btn-success btn-lg mb-3">
                            <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                        </button>
                    </form>
                    <p class="text-muted" style="color: #ffe066 !important;">Klik tombol di atas untuk menyelesaikan pembayaran simulasi. Tidak ada transaksi nyata.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 