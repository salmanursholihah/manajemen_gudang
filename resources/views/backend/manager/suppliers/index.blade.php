@extends('layouts.app')
@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Suppliers</h1>
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
            @foreach ($suppliers as $supplier)
            <tr>
                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                <td class="px-4 py-2 border">{{ $supplier->name }}</td>
                <td class="px-4 py-2 border">{{ $supplier->email }}</td>
                <td class="px-4 py-2 border">{{ $supplier->phone }}</td>
                <td class="px-4 py-2 border">{{ $supplier->address }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('backend.manager.suppliers.edit', $supplier) }}" class="bg-green-500 text-white px-3 py-1 rounded">Edit</a>
                  @if($supplier->status != 'approved')
                        <form action="{{ route('backend.manager.suppliers.approve', $supplier->id) }}" 
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
            {{ $suppliers->firstItem() }} - {{ $suppliers->lastItem() }} 
            dari {{ $suppliers->total() }} produk
        </p>
        <div>
            {{ $suppliers->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection