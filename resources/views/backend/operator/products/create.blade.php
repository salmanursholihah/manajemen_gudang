@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Add Product</h1>

    <form action="{{ route('backend.operator.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="text" name="name" placeholder="Nama Produk" class="w-full border p-2" required>

        <select name="category" class="w-full border p-2" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach(['mekanis','elektrikal','piping','aksesoris','umum'] as $cat)
                <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
            @endforeach
        </select>

        <input type="number" name="stock" placeholder="Stok" class="w-full border p-2" required>
        <input type="text" name="satuan" placeholder="Satuan" class="w-full border p-2" required>
        <textarea name="deskripsi" placeholder="Deskripsi" class="w-full border p-2"></textarea>
        <input type="text" name="lokasi_penyimpanan" placeholder="Lokasi Penyimpanan" class="w-full border p-2">
        <input type="file" name="image" class="w-full border p-2">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
