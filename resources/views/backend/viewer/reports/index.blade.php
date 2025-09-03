@extends('layouts.app')
@section('content')
<div class="p-6">
  <h1 class="text-2xl font-bold mb-6">Reports</h1>

  <!-- Filter -->
  <div class="flex space-x-4 mb-6">
    <input type="date" class="px-3 py-2 border rounded">
    <input type="date" class="px-3 py-2 border rounded">
    <select class="px-3 py-2 border rounded">
      <option>All Reports</option>
      <option>Sales</option>
      <option>Purchases</option>
    </select>
    <button class="px-4 py-2 bg-blue-600 text-white rounded">Generate</button>
  </div>

  <!-- Table Laporan -->
  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">Date</th>
          <th class="px-4 py-2">Type</th>
          <th class="px-4 py-2">Amount</th>
          <th class="px-4 py-2">User</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-2">2025-09-01</td>
          <td class="px-4 py-2">Sales01</td>
          <td class="px-4 py-2">120.000</td>
          <td class="px-4 py-2">sales</td>
        </tr>
      </tbody>
    </table>
  </div>
   <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
        <p>
            Menampilkan 
            {{ $reports->firstItem() }} - {{ $reports->lastItem() }} 
            dari {{ $reports->total() }} produk
        </p>
        <div>
            {{ $reports->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection