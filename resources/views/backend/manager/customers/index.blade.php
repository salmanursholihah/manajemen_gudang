
@extends('layouts.app')
@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Customers</h1>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2 border">#</th>
          <th class="px-4 py-2 border">Name</th>
          <th class="px-4 py-2 border">Email</th>
          <th class="px-4 py-2 border">Phone</th>
          <th class="px-4 py-2 border">Address</th>
          <th class="px-4 py-2 berder">Actions</th>
        </tr>
      </thead>
      <tbody>
         <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                <td class="px-4 py-2 border">{{ $customer->name }}</td>
                <td class="px-4 py-2 border">{{ $customer->email }}</td>
                <td class="px-4 py-2 border">{{ $customer->phone }}</td>
                <td class="px-4 py-2 border">{{ $customer->address }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('backend.manager.customers.edit', $customer) }}" class="bg-green-500 text-white px-3 py-1 rounded">Edit</a>
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
            {{ $customers->firstItem() }} - {{ $customers->lastItem() }} 
            dari {{ $customers->total() }} produk
        </p>
        <div>
            {{ $customers->links('pagination::tailwind') }}
        </div>
</div>
@endsection