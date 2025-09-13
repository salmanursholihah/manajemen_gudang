@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Admin Transactions</h1>
    <a href="{{ route('backend.admin.transactions.create') }}"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mb-4 inline-block">
        + Add Transaction
    </a>

    <table class="w-full bg-white border rounded-lg shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Invoice</th>
                <th class="px-4 py-2">Customer</th>
                <th class="px-4 py-2">Supplier</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $trx->invoice }}</td>
                <td class="px-4 py-2">{{ $trx->customer->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $trx->supplier->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ number_format($trx->total,0,',','.') }}</td>
                <td class="px-4 py-2">{{ $trx->date }}</td>
                <td class="px-4 py-2">{{ ucfirst($trx->status) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('backend.admin.transactions.edit',$trx->id) }}"
                        class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                    <!-- Tombol Compare -->
                    <a href="{{ route('backend.admin.transactions.compare', $trx->id) }}"
                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Compare
                    </a>

                    <form action="{{ route('backend.admin.transactions.destroy',$trx->id) }}" method="POST"
                        class="inline">
                        @csrf @method('DELETE')
                        <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $transactions->links() }}</div>
</div>
@endsection