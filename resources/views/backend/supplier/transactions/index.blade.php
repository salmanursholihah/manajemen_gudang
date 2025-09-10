@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Transactions</h1>
        <a href="{{ route('backend.supplier.transactions.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            + Add Transaction
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg shadow">
  <table class="min-w-full border border-gray-300 text-sm">
    <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Invoice</th>
                    <th class="px-4 py-2 border">Customer</th>
                    <th class="px-4 py-2 border">Supplier</th>
                    <th class="px-4 py-2 border">Type</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $key => $transaction)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $transactions->firstItem() + $key }}</td>
                    <td class="px-4 py-2 border">{{ $transaction->invoice }}</td>
                    <td class="px-4 py-2 border">{{ $transaction->customer->name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $transaction->supplier->name ?? '-' }}</td>
                    <td class="px-4 py-2 capitalize border">{{ $transaction->type }}</td>
                    <td class="px-4 py-2 border">{{ $transaction->date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 border">{{ number_format($transaction->total,0,'.','.') }}</td>
                  
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
        <p>
            Menampilkan {{ $transactions->firstItem() }} - {{ $transactions->lastItem() }}
            dari {{ $transactions->total() }} transaksi
        </p>
        <div>
            {{ $transactions->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
