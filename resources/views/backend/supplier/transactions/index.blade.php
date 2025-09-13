@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Supplier Transactions (Draft Inbound)</h1>
    <a href="{{ route('backend.supplier.transactions.create') }}"
        class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 mb-4 inline-block">
        + Create Draft
    </a>

    <table class="w-full bg-white border rounded-lg shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Invoice</th>
                <th class="px-4 py-2 text-left">Customer</th>
                <th class="px-4 py-2 text-left">Total</th>
                <th class="px-4 py-2 text-left">Date</th>
                <th class="px-4 py-2 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $trx)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $trx->invoice }}</td>
                <td class="px-4 py-2">{{ $trx->customer->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ number_format($trx->total_supplier,0,',','.') }}</td>
                <td class="px-4 py-2">{{ $trx->date }}</td>
                <td class="px-4 py-2">
                    <span
                        class="px-2 py-1 rounded text-xs 
                            {{ $trx->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                        {{ ucfirst($trx->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-3">No transactions</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $transactions->links() }}</div>
</div>
@endsection