@extends('layouts.app')
@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Transactions</h1>
    <a href="{{ route('backend.admin.transactions.create') }}"   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
      + Add Transaction</a>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Invoice</th>
          <th class="px-4 py-2">Customer</th>
          <th class="px-4 py-2">Date</th>
          <th class="px-4 py-2">Total</th>
          <th class="px-4 py-2 text-center">Actions</th>
        </tr>
      </thead>
    <tbody>
@foreach($transactions as $key => $transaction)
<tr class="hover:bg-gray-50">
    <td class="px-4 py-2">{{ $key + 1 }}</td>
    <td class="px-4 py-2">{{ $transaction->invoice }}</td>
    <td class="px-4 py-2">{{ $transaction->customer->name }}</td>
    <td class="px-4 py-2">{{ $transaction->date->format('Y-m-d') }}</td>
    <td class="px-4 py-2">{{ number_format($transaction->total,0,'.','.') }}</td>
    <td class="px-4 py-2 text-center">
        <a href="{{ route('backend.admin.transactions.edit', $transaction) }}" 
           class="px-2 py-1 bg-green-500 text-white rounded">Edit</a>

        <form action="{{ route('backend.admin.transactions.destroy', $transaction) }}" method="POST" class="inline">
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
</div>
@endsection
