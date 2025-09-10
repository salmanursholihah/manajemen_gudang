@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Edit Product</h1>

    <form action="{{ route('backend.operator.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2" required>

        <select name="category" class="w-full border p-2" required>
            @foreach(['mekanis','elektrikal','piping','aksesoris','umum'] as $cat)
                <option value="{{ $cat }}" {{ $product->category == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
            @endforeach
        </select>

        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border p-2" required>
        <input type="text" name="satuan" value="{{ old('satuan', $product->satuan) }}" class="w-full border p-2" required>
        <textarea name="deskripsi" class="w-full border p-2">{{ old('deskripsi', $product->deskripsi) }}</textarea>
        <input type="text" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan', $product->lokasi_penyimpanan) }}" class="w-full border p-2">

        <input type="file" name="image" class="w-full border p-2">
        @if($product->image)
            <p>Current image:</p>
            <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover mt-2">
        @endif

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
