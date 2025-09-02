@extends('layouts.app')
@section('content')

<div class="p-6">
  <!-- Header -->
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Products</h1>
    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
      + Add Product
    </button>
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
          <th class="px-4 py-2 border">#</th>
          <th class="px-4 py-2 border">Name</th>
          <th class="px-4 py-2 border">Category</th>
          <th class="px-4 py-2 border">Price</th>
          <th class="px-4 py-2 border">Stock</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-2 border">1</td>
          <td class="px-4 py-2 border">Laptop</td>
          <td class="px-4 py-2 border">Electronics</td>
          <td class="px-4 py-2 border">$1200</td>
          <td class="px-4 py-2 border">15</td>
          <td class="px-4 py-2 border text-center">
            <button class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Edit</button>
            <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
          </td>
        </tr>
        <!-- Tambahkan data lain -->
      </tbody>
    </table>@extends('layouts.app')
@section('content')

<div class="p-6">
  <!-- Header -->
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Products</h1>
    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
      + Add Product
    </button>
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
          <th class="px-4 py-2 border">#</th>
          <th class="px-4 py-2 border">Name</th>
          <th class="px-4 py-2 border">Category</th>
          <th class="px-4 py-2 border">Price</th>
          <th class="px-4 py-2 border">Stock</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-2 border">1</td>
          <td class="px-4 py-2 border">Laptop</td>
          <td class="px-4 py-2 border">Electronics</td>
          <td class="px-4 py-2 border">Rp 22.000.000</td>
          <td class="px-4 py-2 border">15</td>
          <td class="px-4 py-2 border text-center">
            <button class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Edit</button>
            <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
          </td>
        </tr>
        <!-- Tambahkan data lain -->
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="flex justify-end mt-4">
    <button class="px-3 py-1 border rounded-l">Prev</button>
    <button class="px-3 py-1 border">1</button>
    <button class="px-3 py-1 border">2</button>
    <button class="px-3 py-1 border rounded-r">Next</button>
  </div>
</div>
@endsection
  </div>

  <!-- Pagination -->
  <div class="flex justify-end mt-4">
    <button class="px-3 py-1 border rounded-l">Prev</button>
    <button class="px-3 py-1 border">1</button>
    <button class="px-3 py-1 border">2</button>
    <button class="px-3 py-1 border rounded-r">Next</button>
  </div>
</div>
@endsection