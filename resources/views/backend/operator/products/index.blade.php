@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

    <a href="{{ route('backend.operator.products.create') }}"
       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 mb-4 inline-block">+ Tambah Produk</a>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Nama Produk</th>
                    <th class="p-2 border">Kategori</th>
                    <th class="p-2 border">Stock</th>
                    <th class="p-2 border">Harga</th>
                    <th class="p-2 border">Satuan</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td class="p-2 border">{{ $loop->iteration }}</td>
                    <td class="p-2 border">{{ $product->name }}</td>
                    <td class="p-2 border">{{ $product->category }}</td>
                    <td class="p-2 border">{{ $product->quantity }}</td>
                    <td class="p-2 border">Rp {{ number_format($product->price,0,',','.') }}</td>
                    <td class="p-2 border">{{ $product->satuan }}</td>
                    <td class="p-2 border">{{ ucfirst($product->status) }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('backend.operator.products.edit', $product->id) }}"
                           class="px-2 py-1 bg-blue-600 text-white rounded text-sm">Edit</a>
                        <a href="{{ route('backend.operator.products.destroy', $product->id) }}"
                           class="px-2 py-1 bg-red-600 text-white rounded text-sm">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-3 text-center text-gray-500">Tidak ada produk</td>
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

