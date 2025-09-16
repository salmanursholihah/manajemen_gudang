@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">My Transactions</h1>

    <a href="{{ route('backend.supplier.transactions.create') }}"
       class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 mb-4 inline-block">
        + Create Draft
    </a>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Invoice</th>
                    <th class="px-4 py-2 border">Customer</th>
                    <th class="px-4 py-2 border">Total Supplier</th>
                    <th class="px-4 py-2 border">Document Supplier</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $trx->invoice }}</td>
                    <td class="px-4 py-2 border">{{ $trx->customer->name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ number_format($trx->total_supplier,0,',','.') }}</td>
                    <td class="px-4 py-2 border">
                        @if($trx->document_supplier)
                            <a href="{{ asset('storage/'.$trx->document_supplier) }}" target="_blank" 
                               class="text-blue-600 underline">View</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $trx->date }}</td>
                    <td class="px-4 py-2 border">
                        <span class="px-2 py-1 rounded text-xs 
                            {{ $trx->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                            {{ ucfirst($trx->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border">
                        <a href="#" class="text-sm text-emerald-600 hover:underline">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-3">No transactions</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $transactions->links('pagination::tailwind') }}</div>
</div>
@endsection



