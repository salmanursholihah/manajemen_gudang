@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Produk Baru</h1>

    <form action="{{ route('backend.operator.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <!-- Nama Produk -->
        <div>
            <label for="name" class="block font-semibold">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Kategori -->
        <div>
            <label for="category" class="block font-semibold">Kategori</label>
            <select name="category" id="category" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Kategori --</option>
                <option value="mekanis" {{ old('category')=='mekanis' ? 'selected' : '' }}>Mekanis</option>
                <option value="elektrikal" {{ old('category')=='elektrikal' ? 'selected' : '' }}>Elektrikal</option>
                <option value="piping" {{ old('category')=='piping' ? 'selected' : '' }}>Piping</option>
                <option value="aksesoris" {{ old('category')=='aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                <option value="umum" {{ old('category')=='umum' ? 'selected' : '' }}>Umum</option>
            </select>
            @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Stock -->
        <div>
            <label for="stock" class="block font-semibold">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock',0) }}" class="w-full border rounded px-3 py-2" min="0">
            @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Satuan -->
        <div>
            <label for="satuan" class="block font-semibold">Satuan</label>
            <input type="text" name="satuan" id="satuan" value="{{ old('satuan') }}" class="w-full border rounded px-3 py-2">
            @error('satuan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Harga -->
        <div>
            <label for="price" class="block font-semibold">Harga</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" class="w-full border rounded px-3 py-2" min="0" step="1000">
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full border rounded px-3 py-2">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Lokasi Penyimpanan -->
        <div>
            <label for="lokasi_penyimpanan" class="block font-semibold">Lokasi Penyimpanan</label>
            <input type="text" name="lokasi_penyimpanan" id="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan') }}" class="w-full border rounded px-3 py-2">
            @error('lokasi_penyimpanan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Gambar Produk -->
        <div>
            <label for="image" class="block font-semibold">Gambar Produk</label>
            <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit -->
        <div>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
