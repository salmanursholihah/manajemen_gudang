@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Add Product</h1>
<form action="{{ route('backend.operator.products.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
    @csrf

    <!-- Name -->
    <input type="text" name="name" placeholder="Nama Produk" class="w-full border p-2" required>

    <!-- Category (enum) -->
    <select name="category" class="w-full border p-2" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="mekanis">Mekanis</option>
        <option value="elektrikal">Elektrikal</option>
        <option value="piping">Piping</option>
        <option value="aksesoris">Aksesoris</option>
        <option value="umum">Umum</option>
    </select>

    <!-- Supplier -->
    <select name="suppliers_id" class="w-full border p-2" >
        <option value="">-- Pilih Supplier --</option>
        @foreach($suppliers as $supplier)
            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
        @endforeach
    </select>

    <!-- Stock -->
    <input type="number" name="stock" placeholder="Stok" class="w-full border p-2" required>

    <!-- Satuan -->
    <input type="text" name="satuan" placeholder="Satuan" class="w-full border p-2" required>

    <!-- Deskripsi -->
    <textarea name="deskripsi" placeholder="Deskripsi" class="w-full border p-2"></textarea>

    <!-- Lokasi Penyimpanan -->
    <input type="text" name="lokasi_penyimpanan" placeholder="Lokasi Penyimpanan" class="w-full border p-2">

    <!-- Image Upload -->
    <input type="file" name="image" class="w-full border p-2">

    <!-- Submit -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
</form>

</div>
@endsection
