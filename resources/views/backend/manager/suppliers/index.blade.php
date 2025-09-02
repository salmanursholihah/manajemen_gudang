@extends('layouts.app')
@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Suppliers</h1>
    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Add Supplier</button>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Phone</th>
          <th class="px-4 py-2">Address</th>
          <th class="px-4 py-2 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-2">1</td>
          <td class="px-4 py-2">PT Maju jaya</td>
          <td class="px-4 py-2">suppliermajujaya@mail.com</td>
          <td class="px-4 py-2">+62 812 3456 7890</td>
          <td class="px-4 py-2">Jakarta</td>
          <td class="px-4 py-2 text-center">
            <button class="px-2 py-1 bg-green-500 text-white rounded">Edit</button>
            <button class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection