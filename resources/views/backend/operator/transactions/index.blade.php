@extends('layouts.app')
@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Transactions</h1>
        <a href="{{ route('backend.operator.transactions.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Add Transaction</a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Invoice</th>
                    <th class="px-4 py-2 border">Type</th>
                    <th class="px-4 py-2 border">Customer</th>
                    <th class="px-4 py-2 border">Supplier</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Products</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border">{{ $trx->invoice }}</td>
                    <td class="px-4 py-2 border">{{ ucfirst($trx->type) }}</td>
                    <td class="px-4 py-2 border">{{ $trx->customer->name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $trx->supplier->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ number_format($trx->total_supplier,0,',','.') }}</td>
                    <td class="px-4 py-2 border">{{ $trx->date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 border">
                        <span class="px-2 py-1 rounded
                        @if($trx->status=='approved') bg-green-500 text-white
                        @elseif($trx->status=='rejected') bg-red-500 text-white
                        @else bg-yellow-500 text-white @endif">
                            {{ ucfirst($trx->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border">
                        <ul class="list-disc pl-4">
                            @foreach($trx->items as $item)
                            <li>{{ $item->product->name ?? '-' }} ({{ $item->quantity }}
                                {{ $item->product->satuan ?? '' }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-2 border flex gap-2 justify-center">
                        <a href="{{ route('backend.operator.transactions.edit', $trx->id) }}"
                            class="px-2 py-1 bg-green-500 text-white rounded">Edit</a>
                        <form action="{{ route('backend.operator.transactions.destroy', $trx->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="px-2 py-1 bg-red-500 text-white rounded"
                                onclick="return confirm('Yakin ingin hapus?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center p-3 text-gray-500">No transactions</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $transactions->links('pagination::tailwind') }}</div>
</div>
@endsection