@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Approved Products</h2>
    </div>

    <table class="min-w-full bg-white border">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Category</th>
                <th class="px-4 py-2 border">Supplier</th>
                <th class="px-4 py-2 border">Stock</th>
                <th class="px-4 py-2 border">Price</th>
                <th class="px-4 py-2 border">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="border-b">
                <td class="px-4 py-2 border">{{ $product->id }}</td>
                <td class="px-4 py-2 border">{{ $product->name }}</td>
                <td class="px-4 py-2 border">{{ $product->category }}</td>
                <td class="px-4 py-2 border">{{ $product->supplier->name ?? '-' }}</td>
                <td class="px-4 py-2 border">{{ $product->stock }}</td>
                <td class="px-4 py-2 border">Rp {{ number_format($product->price,0,',','.') }}</td>
                <td class="px-4 py-2 border capitalize">{{ $product->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-2 text-center">No approved products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
