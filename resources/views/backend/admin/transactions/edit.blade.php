@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Transaction</h1>

    <form action="{{ route('backend.admin.transactions.update', $transaction) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Invoice -->
        <input type="text" name="invoice" value="{{ old('invoice', $transaction->invoice) }}" placeholder="Invoice" 
               class="w-full border p-2" required>
        @error('invoice') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Customer -->
        <select name="customer_id" class="w-full border p-2" required>
            <option value="">-- Select Customer --</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" 
                    {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Date -->
        <input type="date" name="date" value="{{ old('date', $transaction->date->format('Y-m-d')) }}" class="w-full border p-2" required>
        @error('date') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Total -->
        <input type="number" name="total" value="{{ old('total', $transaction->total) }}" placeholder="Total" class="w-full border p-2" required>
        @error('total') <p class="text-red-500">{{ $message }}</p> @enderror

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Update Transaction
        </button>
    </form>
</div>
@endsection
