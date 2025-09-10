@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Add Transaction</h1>

    <form action="{{ route('backend.admin.transactions.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Invoice -->
        <input type="text" name="invoice" value="{{ old('invoice') }}" placeholder="Invoice" 
               class="w-full border p-2 rounded" required>
        @error('invoice') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Customer -->
        <select name="customer_id" class="w-full border p-2 rounded" required>
            <option value="">-- Select Customer --</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Supplier -->
        <select name="supplier_id" class="w-full border p-2 rounded" required>
            <option value="">-- Select Supplier --</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
        @error('supplier_id') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Type -->
        <select name="type" class="w-full border p-2 rounded" required>
            <option value="">-- Select Type --</option>
            <option value="pembelian" {{ old('type') == 'pembelian' ? 'selected' : '' }}>Pembelian</option>
            <option value="pembayaran" {{ old('type') == 'pembayaran' ? 'selected' : '' }}>Pembayaran</option>
        </select>
        @error('type') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Date -->
        <input type="date" name="date" value="{{ old('date') }}" class="w-full border p-2 rounded" required>
        @error('date') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Total -->
        <input type="number" name="total" value="{{ old('total') }}" placeholder="Total" 
               class="w-full border p-2 rounded" required>
        @error('total') <p class="text-red-500">{{ $message }}</p> @enderror

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Save Transaction
        </button>
    </form>
</div>
@endsection
