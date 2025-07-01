@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-5" style="color: #ffe066; background: rgba(20,24,48,0.9); border: 2px solid #ffe066;">
                        <div class="card-header bg-primary text-white" style="background: rgba(20,24,48,0.95) !important; color: #ffe066 !important; border-bottom: 2px solid #ffe066;">
                            <h4 class="mb-0 mt-2"><i class="fas fa-list me-2"></i>Riwayat Pesanan</h4>
                </div>
                <div class="card-body">
                    @if(count($orders) > 0)
                        @foreach($orders as $order)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <h6 class="mb-1">Order #{{ $order->id }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $order->created_at->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="mb-1">{{ $order->nama_pemesan }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $order->alamat }}
                                        </small>
                                        @if($order->tracking_number)
                                        <br>
                                        <small class="text-info">
                                            <i class="fas fa-truck me-1"></i>
                                            {{ $order->tracking_number }}
                                        </small>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <span class="price-tag">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="col-md-2">
                                                <span data-order-status-id="{{ $order->id }}" id="status-detail-badge-{{ $order->id }}">
                                        @if($order->status == 'pending')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($order->status == 'processing')
                                            <span class="badge bg-info">Diproses</span>
                                                    @elseif($order->status == 'delivering')
                                                        <span class="badge bg-primary">Dikirim</span>
                                                    @elseif($order->status == 'finished')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                                    @endif
                                                </span>
                                                @if($order->status == 'pending' && auth()->user() && auth()->user()->role == 'admin')
                                                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="mt-2 d-inline">
                                                        @csrf
                                                        <input type="hidden" name="status" value="processing">
                                                        <button type="submit" class="btn btn-sm btn-success">Konfirmasi</button>
                                                    </form>
                                                @endif
                                                @if($order->status == 'delivering' && auth()->user() && auth()->user()->role == 'admin')
                                                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="mt-2 d-inline">
                                                        @csrf
                                                        <input type="hidden" name="status" value="finished">
                                                        <button type="submit" class="btn btn-sm btn-success">Selesaikan</button>
                                                    </form>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        @if($order->payment_status == 'unpaid')
                                            <span class="badge bg-danger">Belum Bayar</span>
                                            <form action="{{ route('orders.confirmPayment', $order->id) }}" method="POST" class="mt-2">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Konfirmasi Pembayaran</button>
                                            </form>
                                        @else
                                            <span class="badge bg-success">Sudah Bayar</span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-receipt me-1"></i>Struk/Detail
                                                </a>
                                                @if(auth()->user() && auth()->user()->role == 'admin')
                                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-outline-primary ms-1">
                                                        <i class="fas fa-edit me-1"></i>Edit
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1 btn-delete-order" data-order-id="{{ $order->id }}" data-order-label="#{{ $order->id }}">
                                                        <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                                @endif
                                    </div>
                                </div>
                                
                                <div class="collapse mt-3" id="order{{ $order->id }}">
                                    <div class="card card-body bg-light">
                                        <h6>Detail Pesanan:</h6>
                                        @php $items = json_decode($order->items, true); @endphp
                                        @foreach($items as $item)
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>{{ $item['nama'] }} x{{ $item['qty'] }}</span>
                                            <span>Rp{{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</span>
                                        </div>
                                        @endforeach
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <strong>Total</strong>
                                            <strong>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-receipt mb-3" style="font-size: 4rem; color: #ccc;"></i>
                            <h5 class="text-muted">Belum Ada Pesanan</h5>
                            <p class="text-muted">Anda belum memiliki riwayat pesanan</p>
                            <a href="{{ route('foods.index') }}" class="btn btn-primary">
                                <i class="fas fa-utensils me-2"></i>Pesan Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<!-- Modal Hapus Global -->
<div class="modal fade" id="deleteOrderModalGlobal" tabindex="-1" aria-labelledby="deleteOrderModalLabelGlobal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteOrderModalLabelGlobal">Konfirmasi Hapus Pesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus pesanan <strong id="deleteOrderLabel">#</strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form id="deleteOrderForm" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal hapus
    document.querySelectorAll('.btn-delete-order').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var orderId = this.getAttribute('data-order-id');
            var orderLabel = this.getAttribute('data-order-label');
            var form = document.getElementById('deleteOrderForm');
            var label = document.getElementById('deleteOrderLabel');
            form.action = '/orders/' + orderId;
            label.textContent = orderLabel;
            var modal = new bootstrap.Modal(document.getElementById('deleteOrderModalGlobal'));
            modal.show();
        });
    });

    // Polling status pesanan (auto update status di riwayat)
    setInterval(function() {
        document.querySelectorAll('[data-order-status-id]').forEach(function(el) {
            var orderId = el.getAttribute('data-order-status-id');
            fetch('/orders/' + orderId)
                .then(res => res.text())
                .then(html => {
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(html, 'text/html');
                    var statusDetail = doc.querySelector('#status-detail-badge');
                    if(statusDetail) {
                        var target = document.getElementById('status-detail-badge-' + orderId);
                        if(target) target.innerHTML = statusDetail.innerHTML;
                    }
                });
        });
    }, 4000);
});
</script>
<style>
.card, .card-header, .card-body {
    background: rgba(20,24,48,0.9) !important;
    color: #ffe066 !important;
    border: 2px solid #ffe066 !important;
}
.card-header.bg-primary {
    background: rgba(20,24,48,0.95) !important;
    color: #ffe066 !important;
    border-bottom: 2px solid #ffe066 !important;
    text-shadow: 0 0 8px #ffe06699;
    box-shadow: 0 0 16px #ffe06655;
}
.card .text-muted, .card .text-info, .card .text-end, .card .text-center, .card h6, .card h4, .card h5, .card p, .card small, .card strong {
    color: #ffe066 !important;
}
</style>
@endsection 