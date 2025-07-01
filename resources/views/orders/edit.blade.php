@extends('layouts.app')

@section('title', 'Edit Pesanan')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Pesanan #{{ $order->id }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" class="form-control" value="{{ old('nama_pemesan', $order->nama_pemesan) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" required>{{ old('alamat', $order->alamat) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Harga</label>
                            <input type="number" name="total_harga" class="form-control" value="{{ old('total_harga', $order->total_harga) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="delivering" {{ old('status', $order->status) == 'delivering' ? 'selected' : '' }}>Dalam Pengiriman</option>
                                <option value="finished" {{ old('status', $order->status) == 'finished' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="simulasi" {{ old('payment_method', $order->payment_method) == 'simulasi' ? 'selected' : '' }}>Simulasi</option>
                                <option value="offline" {{ old('payment_method', $order->payment_method) == 'offline' ? 'selected' : '' }}>Offline</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Pembayaran</label>
                            <select name="payment_status" class="form-select" required>
                                <option value="unpaid" {{ old('payment_status', $order->payment_status) == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="paid" {{ old('payment_status', $order->payment_status) == 'paid' ? 'selected' : '' }}>Sudah Bayar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 