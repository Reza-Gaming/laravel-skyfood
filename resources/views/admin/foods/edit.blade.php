@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Menu Makanan</h2>
    <form action="{{ route('admin.foods.update', $food->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $food->nama) }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $food->deskripsi) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $food->harga) }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">- Pilih Kategori -</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $food->category_id) == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="gambar_upload" class="form-label">Upload Gambar (opsional)</label>
            <input type="file" class="form-control" id="gambar_upload" name="gambar_upload" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="gambar_link" class="form-label">Atau Link Gambar</label>
            <input type="url" class="form-control" id="gambar_link" name="gambar_link" value="{{ old('gambar_link', filter_var($food->gambar, FILTER_VALIDATE_URL) ? $food->gambar : '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            @if($food->gambar)
                @if(filter_var($food->gambar, FILTER_VALIDATE_URL))
                    <img src="{{ $food->gambar }}" alt="Gambar" style="max-width:200px;max-height:200px;">
                @else
                    <img src="{{ asset('storage/'.$food->gambar) }}" alt="Gambar" style="max-width:200px;max-height:200px;">
                @endif
            @else
                <span class="text-muted">Belum ada gambar</span>
            @endif
        </div>
        <div class="mb-3" id="preview-container" style="display:none;">
            <label class="form-label">Preview Gambar Link</label><br>
            <img id="preview-img" src="" alt="Preview" style="max-width:200px;max-height:200px;">
        </div>
        <script>
        document.getElementById('gambar_link').addEventListener('input', function() {
            var val = this.value;
            var preview = document.getElementById('preview-img');
            var container = document.getElementById('preview-container');
            if(val) {
                preview.src = val;
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        });
        </script>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 