@extends('layouts.app')
@section('content')

<div class="p-6">
  <!-- Header -->
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Products</h1>
    <a href="{{ route('backend.admin.products.create') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
       + Add Product
    </a>
  </div>

  <!-- Search & Filter -->
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-4">
    <input type="text" placeholder="Search products..."
      class="px-3 py-2 border rounded-lg w-full md:w-1/3" />
    <select class="px-3 py-2 border rounded-lg w-full md:w-1/4">
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
          <th class="px-4 py-2 border">Satuan</th>
          <th class="px-4 py-2 border">Deskripsi</th>
          <th class="px-4 py-2 border">Lokasi</th>
          <th class="px-4 py-2 border">Image</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
        <tr>
          <td data-label="Id" class="px-4 py-2 border">{{ $loop->iteration }}</td>
          <td data-label="Name" class="px-4 py-2 border">{{ $product->name }}</td>
          <td data-label="Category" class="px-4 py-2 border">{{ $product->category }}</td>
          <td data-label="Supplier" class="px-4 py-2 border">{{ $product->supplier_id }}</td>
          <td data-label="Stock" class="px-4 py-2 border">{{ $product->stock }}</td>
          <td data-label="Satuan" class="px-4 py-2 border">{{ $product->satuan }}</td>
          <td data-label="Deskripsi" class="px-4 py-2 border">{{ $product->deskripsi }}</td>
          <td data-label="Lokasi" class="px-4 py-2 border">{{ $product->lokasi_penyimpanan }}</td>
          <td data-label="Image" class="px-4 py-2 border">{{ $product->image }}</td>
          <td data-label="Actions" class="px-4 py-2 border space-y-1 md:space-y-0 md:space-x-1">
            <a href="{{ route('backend.admin.products.edit', $product) }}"
               class="bg-green-500 text-white px-3 py-1 rounded block md:inline-block text-center">Edit</a>

            <form action="{{ route('backend.admin.products.destroy', $product) }}"
                  method="POST" class="inline">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="bg-red-500 text-white px-3 py-1 rounded block md:inline-block w-full md:w-auto"
                      onclick="return confirm('Are you sure?')">
                Delete
              </button>
            </form>

            <form action="{{ route('backend.admin.products.validate',$product->id) }}"
                  method="POST" class="inline">
              @csrf
              <button class="bg-purple-500 text-white px-3 py-1 rounded block md:inline-block w-full md:w-auto">
                Validate
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="mt-4 flex flex-col md:flex-row md:justify-between md:items-center text-sm text-gray-600 gap-2">
    <p>
      Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }}
      dari {{ $products->total() }} produk
    </p>
    <div>
      {{ $products->links('pagination::tailwind') }}
    </div>
  </div>
</div>
@endsection
