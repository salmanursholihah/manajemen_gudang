@extends('layouts.app')
@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Suppliers</h1>
    <a href="{{ route('backend.admin.suppliers.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Add Supplier</a>
  </div>

  <div class="w-full border border-gray-300 rounded-lg">
    <table class="w-full">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 border">#</th>
          <th class="px-4 py-2 border">Name</th>
          <th class="px-4 py-2 border">Email</th>
          <th class="px-4 py-2 border">Phone</th>
          <th class="px-4 py-2 border">Address</th>
          <th class="px-4 py-2 text-center border">Actions</th>
        </tr>
      </thead>
      <tbody>
         <tbody>
            @foreach ($suppliers as $supplier)
            <tr>
                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                <td class="px-4 py-2 border">{{ $supplier->name }}</td>
                <td class="px-4 py-2 border">{{ $supplier->email }}</td>
                <td class="px-4 py-2 border">{{ $supplier->phone }}</td>
                <td class="px-4 py-2 border">{{ $supplier->address }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('backend.admin.suppliers.edit', $supplier) }}" class="bg-green-500 text-white px-3 py-1 rounded">Edit</a>
                    <form action="{{ route('backend.admin.suppliers.destroy', $supplier) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded"
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
            {{ $suppliers->firstItem() }} - {{ $suppliers->lastItem() }} 
            dari {{ $suppliers->total() }} produk
        </p>
        <div>
            {{ $suppliers->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection