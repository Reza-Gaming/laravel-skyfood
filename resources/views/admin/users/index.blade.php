@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 mt-4">
        <div class="col-md-6">
            <h2 class="mb-3"><i class="fas fa-users me-2"></i>Manajemen User</h2>
        </div>
        <div class="col-md-6 text-end mt-2">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary me-2">
                <i class="fas fa-plus me-2"></i>Tambah User
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar User</h5>
        </div>
        <div class="card-body">
            @if(count($users) > 0)
                <div class="table-responsive">
                    <table class="table table-hover" style="color: #ffe066; border-color: #ffe066; background: rgba(20,24,48,0.7);">
                        <thead class="table-light" style="background: rgba(20,24,48,0.95); color: #ffe066; border-bottom: 2px solid #ffe066;">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @else
                                        <span class="badge bg-info">User</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users mb-3" style="font-size: 4rem; color: #ccc;"></i>
                    <h5 class="text-muted">Belum Ada User</h5>
                    <p class="text-muted">Belum ada user yang terdaftar</p>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah User Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus user <strong id="userName"></strong>?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(userId, userName) {
    document.getElementById('userName').textContent = userName;
    document.getElementById('deleteForm').action = `/admin/users/${userId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 14px;
    font-weight: bold;
}
.table, .table-hover, .table-bordered, .table td, .table th {
    color: #ffe066 !important;
    border-color: #ffe066 !important;
    background: rgba(20, 24, 48, 0.7) !important;
}
.table-light th {
    background: rgba(20, 24, 48, 0.95) !important;
    color: #ffe066 !important;
    border-bottom: 2px solid #ffe066 !important;
}
.card-header.bg-primary {
    background: rgba(20,24,48,0.95) !important;
    color: #ffe066 !important;
    border-bottom: 2px solid #ffe066 !important;
    text-shadow: 0 0 8px #ffe06699;
    box-shadow: 0 0 16px #ffe06655;
}
</style>
@endsection 