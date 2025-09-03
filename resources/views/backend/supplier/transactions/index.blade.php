@extends('layouts.app')
@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Transactions</h1>
    <button onclick="openModal()" 
      class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
      + Add Transaction
    </button>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Invoice</th>
          <th class="px-4 py-2">Customer</th>
          <th class="px-4 py-2">Date</th>
          <th class="px-4 py-2">Total</th>
          <th class="px-4 py-2 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-2">1</td>
          <td class="px-4 py-2">INV-001</td>
          <td class="px-4 py-2">mimin sarimin</td>
          <td class="px-4 py-2">2025-09-01</td>
          <td class="px-4 py-2">22.000.000</td>
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
