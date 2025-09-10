@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Products</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full border border-gray-300 rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Image</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Stock</th>
                    <th class="px-4 py-2 border">Satuan</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Supplier</th>
                    <th class="px-4 py-2 border">Lokasi</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded">
                    </td>
                    <td class="px-4 py-2 border">
                        <div class="font-semibold">{{ $product->name }}</div>
                        <div class="text-sm text-gray-500">{{ Str::limit($product->deskripsi, 30) }}</div>
                    </td>
                    <td class="px-4 py-2 border">
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                            {{ ucfirst($product->category) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border">{{ $product->stock }}</td>
                    <td class="px-4 py-2 border">{{ $product->satuan }}</td>
                    <td class="px-4 py-2 border">
                        @if($product->status == 'approv')
                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Approved</span>
                        @elseif($product->status == 'rejected')
                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Rejected</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Pending</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $product->supplier?->name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $product->lokasi_penyimpanan }}</td>
                    <td class="p-3 space-x-1">
                        <a href="{{ route('backend.manager.products.edit', $product->id) }}" 
                           class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                           Edit
                        </a>
                        @if($product->status != 'approv')
                        <form action="{{ route('backend.manager.products.approve', $product->id) }}" 
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
                @empty
                <tr>
                    <td colspan="10" class="p-3 text-center text-gray-500">No products available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection


