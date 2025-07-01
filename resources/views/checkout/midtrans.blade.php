@extends('layouts.app')

@section('title', 'Pembayaran Midtrans')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3 class="mb-4">Pembayaran</h3>
                    <button id="pay-button" class="btn btn-success btn-lg mb-3">
                        <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                    </button>
                    <p class="text-muted">Klik tombol di atas untuk melanjutkan pembayaran melalui Midtrans.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function(){
        window.snap.pay(@json($snapToken), {
            onSuccess: function(result){
                alert('Pembayaran berhasil!');
                window.location.href = '/orders';
            },
            onPending: function(result){
                alert('Pembayaran pending!');
                window.location.href = '/orders';
            },
            onError: function(result){
                alert('Pembayaran gagal!');
            }
        });
    }
</script>
@endsection 