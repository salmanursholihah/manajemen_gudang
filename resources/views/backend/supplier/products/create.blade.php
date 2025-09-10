@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Add Product</h1>

    <form action="{{ route('backend.supplier.products.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <input type="text" name="name" placeholder="Nama Produk" class="w-full border p-2" value="{{ old('name') }}" required>

        <!-- Category -->
        <select name="category" class="w-full border p-2" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach(['mekanis','elektrikal','piping','aksesoris','umum'] as $cat)
                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                    {{ ucfirst($cat) }}
                </option>
            @endforeach
        </select>

        <!-- Jumlah (akan dipetakan ke stock di controller) -->
        <input type="number" name="jumlah" placeholder="Jumlah" class="w-full border p-2" value="{{ old('jumlah') }}" required>

        <!-- Satuan -->
        <input type="text" name="satuan" placeholder="Satuan" class="w-full border p-2" value="{{ old('satuan') }}" required>

        <!-- Deskripsi -->
        <textarea name="deskripsi" placeholder="Deskripsi" class="w-full border p-2">{{ old('deskripsi') }}</textarea>

        <!-- Image Upload -->
        <input type="file" name="image" class="w-full border p-2">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
