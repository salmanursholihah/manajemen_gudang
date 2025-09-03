
@extends('layouts.app')
@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Customers</h1>
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
                        @if($customer->status != 'approved')
                        <form action="{{ route('backend.manager.customers.approve', $customer->id) }}" 
                              method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    Approve
                            </button>
                        </form>
                        @endif
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