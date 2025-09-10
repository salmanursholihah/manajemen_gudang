@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Transaction</h1>

    <form action="{{ route('backend.admin.transactions.update', $transaction->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Invoice -->
        <input type="text" name="invoice" value="{{ old('invoice', $transaction->invoice) }}" 
               placeholder="Invoice" class="w-full border p-2 rounded" required>
        @error('invoice') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Customer -->
        <select name="customer_id" class="w-full border p-2 rounded" required>
            <option value="">-- Select Customer --</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" 
                    {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Supplier -->
        <select name="supplier_id" class="w-full border p-2 rounded" required>
            <option value="">-- Select Supplier --</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" 
                    {{ old('supplier_id', $transaction->supplier_id) == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
        @error('supplier_id') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Type -->
        <select name="type" class="w-full border p-2 rounded" required>
            <option value="">-- Select Type --</option>
            <option value="pembelian" {{ old('type', $transaction->type) == 'pembelian' ? 'selected' : '' }}>Pembelian</option>
            <option value="pembayaran" {{ old('type', $transaction->type) == 'pembayaran' ? 'selected' : '' }}>Pembayaran</option>
        </select>
        @error('type') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Date -->
        <input type="date" name="date" value="{{ old('date', $transaction->date->format('Y-m-d')) }}" 
               class="w-full border p-2 rounded" required>
        @error('date') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Total -->
        <input type="number" name="total" value="{{ old('total', $transaction->total) }}" 
               placeholder="Total" class="w-full border p-2 rounded" required>
        @error('total') <p class="text-red-500">{{ $message }}</p> @enderror

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Update Transaction
        </button>
    </form>
</div>
@endsection
