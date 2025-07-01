@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row">
                <!-- Kiri: Info & Item -->
                <div class="col-md-7 mb-4">
                    <div class="card mb-3 shadow-sm border-0" style="background: rgba(20,24,48,0.9); color: #ffe066; margin-top: 1.5rem; margin-bottom: 1.5rem; border: 2px solid #ffe066;">
                        <div class="card-header bg-primary text-white rounded-top">
                            <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Detail Pesanan</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="mb-2"><i class="fas fa-hashtag me-2 text-secondary"></i><strong>Order ID:</strong> #{{ $order->id }}</div>
                                    <div class="mb-2"><i class="fas fa-calendar-alt me-2 text-secondary"></i><strong>Waktu Pesan:</strong> {{ $order->created_at->format('d M Y H:i') }}</div>
                                    <div class="mb-2"><i class="fas fa-user me-2 text-secondary"></i><strong>Nama Pemesan:</strong> {{ $order->nama_pemesan }}</div>
                                    <div class="mb-2"><i class="fas fa-barcode me-2 text-secondary"></i><strong>No. Resi:</strong> {{ $order->tracking_number }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2"><i class="fas fa-map-marker-alt me-2 text-secondary"></i><strong>Alamat:</strong> {{ $order->alamat }}</div>
                                    <div class="mb-2"><i class="fas fa-credit-card me-2 text-secondary"></i><strong>Metode Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</div>
                                    <div class="mb-2"><i class="fas fa-clock me-2 text-secondary"></i><strong>Estimasi Selesai:</strong> {{ $order->estimated_delivery ? $order->estimated_delivery->format('d M Y H:i') : '-' }}</div>
                                    <div class="mb-2"><i class="fas fa-money-bill-wave me-2 text-secondary"></i><strong>Status Pembayaran:</strong> <span class="badge px-3 py-2 fs-6 bg-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">{{ $order->payment_status == 'paid' ? 'Lunas' : 'Belum Bayar' }}</span></div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="mb-3"><i class="fas fa-list me-2"></i>Daftar Pesanan:</h6>
                            @php $items = is_array($order->items) ? $order->items : json_decode($order->items, true); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle bg-white" style="color: #ffe066; border-color: #ffe066; background: rgba(20,24,48,0.7);">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Menu</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{ $item['qty'] }}</td>
                                            <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                                            <td>Rp{{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end align-items-center mt-3">
                                <span class="me-2 fw-bold fs-5">Total</span>
                                <span class="price-tag fs-5">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Kanan: Status Pesanan -->
                <div class="col-md-5 mb-4">
                    <div class="card mb-3" style="background: rgba(20,24,48,0.9); color: #ffe066; border: 2px solid #ffe066; margin-top: 1.5rem; margin-bottom: 1.5rem;">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-truck me-2"></i>Status Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <!-- Progress Bar -->
                            <div class="mb-3">
                                <div class="progress" style="height: 18px;">
                                    <div id="order-progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 0%; transition: width 0.7s; font-weight: bold; font-size: 1rem;">
                                        0%
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush mb-3" id="status-list">
                                <li class="list-group-item status-step" id="status-pending">
                                    <i class="fas fa-hourglass-half me-2"></i>Menunggu Konfirmasi
                                </li>
                                <li class="list-group-item status-step" id="status-confirmed">
                                    <i class="fas fa-check me-2"></i>Dikonfirmasi
                                </li>
                                <li class="list-group-item status-step" id="status-cooking">
                                    <i class="fas fa-fire me-2"></i>Memasak
                                </li>
                                <li class="list-group-item status-step" id="status-ready">
                                    <i class="fas fa-utensils me-2"></i>Siap Diantar
                                </li>
                                <li class="list-group-item status-step" id="status-delivering">
                                    <i class="fas fa-motorcycle me-2"></i>Dalam Pengiriman
                                </li>
                                <li class="list-group-item status-step" id="status-finished">
                                    <i class="fas fa-check-circle me-2"></i>Selesai
                                </li>
                            </ul>
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary w-100 mb-2"><i class="fas fa-arrow-left me-1"></i>Kembali ke Pesanan</a>
                            <button id="auto-update-btn" type="button" class="btn btn-success w-100">Simulasikan Proses Otomatis</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Bootstrap -->
<div class="modal fade" id="enjoyModal" tabindex="-1" aria-labelledby="enjoyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title w-100 text-center" id="enjoyModalLabel"><i class="fas fa-smile-beam me-2"></i>Selamat Menikmati Makanan!</h5>
      </div>
      <div class="modal-body text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" alt="Enjoy" style="width: 100px; margin-bottom: 20px;">
        <h4 class="mb-3">Pesanan Anda telah selesai diproses.</h4>
        <p class="mb-0">Terima kasih telah memesan di <strong>Skyfood</strong>.<br>Semoga makanan Anda lezat dan memuaskan!</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<style>
.status-step, .list-group-item.status-step {
    background: transparent !important;
    color: #ffe066 !important;
    border: none !important;
}
.status-step.active {
    background: linear-gradient(90deg, #ffe066 60%, #fffbe7 100%) !important;
    color: #232946 !important;
    font-weight: bold;
    border-left: 5px solid #ffe066;
    box-shadow: 0 0 12px #ffe06699;
}
.status-step.done {
    background: rgba(255, 255, 224, 0.15) !important;
    color: #ffe066 !important;
    font-weight: 500;
}
.table, .table-bordered, .table td, .table th {
    color: #ffe066 !important;
    border-color: #ffe066 !important;
    background: rgba(20, 24, 48, 0.7) !important;
}
.table-light th {
    background: rgba(20, 24, 48, 0.95) !important;
    color: #ffe066 !important;
    border-bottom: 2px solid #ffe066 !important;
}
.card-header.bg-primary, .card-header.bg-success {
    background: rgba(20,24,48,0.95) !important;
    color: #ffe066 !important;
    border-bottom: 2px solid #ffe066 !important;
    text-shadow: 0 0 8px #ffe06699;
    box-shadow: 0 0 16px #ffe06655;
}
.progress {
    background: rgba(20,24,48,0.7) !important;
    border-radius: 12px;
    border: 2px solid #ffe066;
    box-shadow: 0 0 8px #ffe06655;
}
.progress-bar {
    background: linear-gradient(90deg, #ffe066 60%, #fffbe7 100%) !important;
    color: #232946 !important;
    font-weight: bold;
    text-shadow: 0 0 4px #ffe06699;
    box-shadow: 0 0 16px #ffe06699;
}
/* Modal Enjoy */
#enjoyModal .modal-content {
    background: rgba(20,24,48,0.97) !important;
    color: #ffe066 !important;
    border: 2px solid #ffe066;
    border-radius: 18px;
    box-shadow: 0 0 24px #ffe06655;
}
#enjoyModal .modal-header, #enjoyModal .modal-footer {
    background: transparent !important;
    border: none;
}
#enjoyModal .modal-title, #enjoyModal h4, #enjoyModal p, #enjoyModal strong {
    color: #ffe066 !important;
    text-shadow: 0 0 8px #ffe06699;
}
#enjoyModal .btn-success {
    background: #ffe066 !important;
    color: #232946 !important;
    border: none;
    font-weight: bold;
    box-shadow: 0 0 8px #ffe06699;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var btn = document.getElementById('auto-update-btn');
    var statusSteps = [
        {id: 'status-pending', class: 'fw-bold text-warning', value: 'pending'},
        {id: 'status-confirmed', class: 'fw-bold text-primary', value: 'processing'},
        {id: 'status-cooking', class: 'fw-bold text-danger', value: 'cooking'},
        {id: 'status-ready', class: 'fw-bold text-info', value: 'ready'},
        {id: 'status-delivering', class: 'fw-bold text-primary', value: 'delivering'},
        {id: 'status-finished', class: 'fw-bold text-success', value: 'finished'}
    ];
    var progressBar = document.getElementById('order-progress-bar');
    function highlightStatus(step) {
        statusSteps.forEach(function(s, idx) {
            var el = document.getElementById(s.id);
            el.className = 'list-group-item status-step';
            if(idx < step) {
                el.classList.add('done');
            } else if(idx === step) {
                el.classList.add('active');
            }
        });
        // Progress bar
        if(progressBar) {
            var percent = Math.round((step) / (statusSteps.length-1) * 100);
            progressBar.style.width = percent + '%';
            progressBar.innerText = percent + '%';
        }
    }
    function updateBackendStatus(orderId, status) {
        fetch(`/orders/${orderId}/update-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `status=${status}`
        });
    }
    if (btn) {
        btn.onclick = function() {
            this.disabled = true;
            this.innerText = 'Memproses...';
            let step = 0;
            highlightStatus(step);
            updateBackendStatus({{ $order->id }}, statusSteps[step].value);
            let interval = setInterval(function() {
                step++;
                if(step < statusSteps.length) {
                    highlightStatus(step);
                    updateBackendStatus({{ $order->id }}, statusSteps[step].value);
                } else {
                    clearInterval(interval);
                    // Setelah animasi selesai, update status di backend ke finished (sekali lagi untuk jaga-jaga)
                    updateBackendStatus({{ $order->id }}, 'finished');
                    btn.innerText = 'Selesai';
                    btn.className = 'btn btn-secondary w-100';
                    // Tampilkan modal Bootstrap
                    var enjoyModal = new bootstrap.Modal(document.getElementById('enjoyModal'));
                    enjoyModal.show();
                }
            }, 3000);
        };
    }
    // Highlight status sesuai status awal (jika reload)
    let initialStep = 0;
    @if($order->status == 'pending') initialStep = 0;
    @elseif($order->status == 'processing') initialStep = 1;
    @elseif($order->status == 'cooking') initialStep = 2;
    @elseif($order->status == 'ready') initialStep = 3;
    @elseif($order->status == 'delivering') initialStep = 4;
    @elseif($order->status == 'finished') initialStep = 5;
    @endif
    highlightStatus(initialStep);
});
</script>
@endsection 