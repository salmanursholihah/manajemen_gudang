@extends('layouts.app')
@section('content')

<div class="p-6">
  <!-- Header -->
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Products</h1>
    <a href="{{ route('backend.operator.products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"> + Add Product</a>

  </div>

  <!-- Search & Filter -->
  <div class="flex items-center justify-between mb-4">
    <input type="text" placeholder="Search products..."
      class="px-3 py-2 border rounded-lg w-1/3" />
    <select class="px-3 py-2 border rounded-lg">
      <option>All Categories</option>
      <option>Electronics</option>
      <option>Food</option>
    </select>
  </div>
<!-- Table -->
<div class="overflow-x-auto rounded-lg shadow">
  <table class="min-w-full border border-gray-300 text-sm">
    <thead class="bg-gray-200 text-gray-700">
      <tr>
        <th class="px-4 py-2 border">Id</th>
        <th class="px-4 py-2 border">Name</th>
        <th class="px-4 py-2 border">Category</th>
        <th class="px-4 py-2 border">Suppliers</th>
        <th class="px-4 py-2 border">Stock</th>
        <th class="px-4 py-2 border">Satuan</th>
        <th class="px-4 py-2 border">Deskripsi</th>
        <th class="px-4 py-2 border">Lokasi</th>
        <th class="px-4 py-2 border">Image</th>
        <th class="px-4 py-2 border">Actions</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
      @foreach ($products as $product)
      <tr class="hover:bg-gray-50">
        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
        <td class="px-4 py-2 border">{{ $product->name }}</td>
        <td class="px-4 py-2 border">{{ $product->category }}</td>
        <td class="px-4 py-2 border">{{ $product->supplier_id }}</td>
        <td class="px-4 py-2 border">{{ $product->stock }}</td>
        <td class="px-4 py-2 border">{{ $product->satuan }}</td>
        <td class="px-4 py-2 border">{{ $product->deskripsi }}</td>
        <td class="px-4 py-2 border">{{ $product->lokasi_penyimpanan }}</td>
        <td class="px-4 py-2 border">
          @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="h-12 w-12 object-cover rounded">
          @else
            <span class="text-gray-400 italic">No image</span>
          @endif
        </td>
        <td class="px-4 py-2 border space-x-2">
          <a href="{{ route('backend.operator.products.edit', $product) }}" class="bg-green-500 text-white px-3 py-1 rounded text-xs">Edit</a>
          <form action="{{ route('backend.operator.products.destroy', $product) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-xs"
              onclick="return confirm('Are you sure?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


 <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
        <p>
            Menampilkan 
            {{ $products->firstItem() }} - {{ $products->lastItem() }} 
            dari {{ $products->total() }} produk
        </p>
        <div>
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
