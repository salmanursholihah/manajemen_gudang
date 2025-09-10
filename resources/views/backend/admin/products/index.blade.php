@extends('layouts.app')
@section('content')

<div class="p-6">
  <!-- Header -->
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Products</h1>
    <a href="{{ route('backend.admin.products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"> + Add Product</a>

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
  <div class="overflow-x-auto">
    <table class="w-full border border-gray-300 rounded-lg">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 border">Id</th>
          <th class="px-4 py-2 border">Name</th>
          <th class="px-4 py-2 border">Category</th>
          <th class="px-4 py-2 border">Suppliers</th>
          <th class="px-4 py-2 border">Stock</th>
          <th class="px-4 py-2 border">satuan</th>
          <th class="px-4 py-2 border">deskripsi</th>
          <th class="px-4 py-2 border">lokasi penyimpanan</th>
          <th class="px-4 py-2 border">image</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
   <tbody>
            @foreach ($products as $product)
            <tr>
                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                <td class="px-4 py-2 border">{{ $product->name }}</td>
                <td class="px-4 py-2 border">{{ $product->category }}</td>
                <td class="px-4 py-2 border">{{ $product->supplier_id }}</td>
                <td class="px-4 py-2 border">{{ $product->stock }}</td>
                <td class="px-4 py-2 border">{{ $product->satuan }}</td>
                <td class="px-4 py-2 border">{{ $product->deskripsi }}</td>
                <td class="px-4 py-2 border">{{ $product->lokasi_penyimpanan }}</td>
                <td class="px-4 py-2 border">{{ $product->image }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('backend.admin.products.edit', $product) }}" class="bg-green-500 text-white px-3 py-1 rounded">Edit</a>
                    <form action="{{ route('backend.admin.products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                      <form action="{{ route('backend.admin.products.validate',$product->id) }}" method="POST" class="inline">
                        @csrf 
                        <button class="bg-purple-500 text-white px-3 py-1 rounded">Validate</button></form>

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


