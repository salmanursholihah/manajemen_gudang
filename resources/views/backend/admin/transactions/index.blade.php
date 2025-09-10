@extends('layouts.app')
@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Transactions</h1>
        <a href="{{ route('backend.admin.transactions.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            + Add Transaction</a>
    </div>

  <div class="overflow-x-auto">
    <table class="w-full border border-gray-300 rounded-lg">
      <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Invoice</th>
                    <th class="px-4 py-2 border">Customer</th>
                    <th class="px-4 py-2 border">Supplier</th>
                    <th class="px-4 py-2 border">Type</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 text-center border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $key => $transaction)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $transaction->invoice }}</td>
                    <td class="px-4 py-2 border">{{ $transaction->customer->name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $transaction->supplier->name ?? '-' }}</td>
                    <td class="px-4 py-2 capitalize border">{{ $transaction->type }}</td>
                    <td class="px-4 py-2 border">
                        {{ $transaction->date instanceof \Carbon\Carbon ? $transaction->date->format('Y-m-d') : $transaction->date }}
                    </td>
                    <td class="px-4 py-2 border">{{ number_format($transaction->total,0,',','.') }}</td>
                    <td class="px-4 py-2 text-center border">
                        <a href="{{ route('backend.admin.transactions.edit', $transaction) }}"
                            class="px-2 py-1 bg-green-500 text-white rounded">Edit</a>

                        <form action="{{ route('backend.admin.transactions.destroy', $transaction) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
       <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
        <p>
            Showing {{ $transactions->firstItem() }} - {{ $transactions->lastItem() }} of {{ $transactions->total() }}
        </p>
        <div>
            {{ $transactions->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
