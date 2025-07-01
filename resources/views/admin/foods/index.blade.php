@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Menu Makanan</h2>
    <a href="{{ route('admin.foods.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered" style="color: #ffe066;">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foods as $food)
            <tr>
                <td>{{ $food->nama }}</td>
                <td>{{ $food->deskripsi }}</td>
                <td>Rp{{ number_format($food->harga,0,',','.') }}</td>
                <td>{{ $food->category_id ? optional($food->category)->nama : '-' }}</td>
                <td>
                    @if($food->gambar)
                        @if(filter_var($food->gambar, FILTER_VALIDATE_URL))
                            <img src="{{ $food->gambar }}" alt="Gambar" style="max-width:80px;max-height:80px;">
                        @else
                            <img src="{{ asset('storage/'.$food->gambar) }}" alt="Gambar" style="max-width:80px;max-height:80px;">
                        @endif
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.foods.edit', $food->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 