@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Edit Product</h1>

    <form action="{{ route('backend.admin.products.update', $product) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2" required>

        <!-- Category -->
        <select name="category" class="w-full border p-2" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach(['mekanis','elektrikal','piping','aksesoris','umum'] as $cat)
                <option value="{{ $cat }}" {{ $product->category == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
            @endforeach
        </select>

        <!-- Supplier -->
        <select name="supplier_id" class="w-full border p-2" required>
            <option value="">-- Pilih Supplier --</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>

        <!-- Stock -->
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border p-2" required>

        <!-- Quantity -->
        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full border p-2" required>

        <!-- Satuan -->
        <input type="text" name="satuan" value="{{ old('satuan', $product->satuan) }}" class="w-full border p-2" required>

        <!-- Price -->
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full border p-2" required>

        <!-- Deskripsi -->
        <textarea name="deskripsi" class="w-full border p-2">{{ old('deskripsi', $product->deskripsi) }}</textarea>

        <!-- Lokasi Penyimpanan -->
        <input type="text" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan', $product->lokasi_penyimpanan) }}" class="w-full border p-2">

        <!-- Image Upload -->
        <input type="file" name="image" class="w-full border p-2">
        @if($product->image)
            <p>Gambar saat ini: <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-32 h-32 mt-2"></p>
        @endif

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
