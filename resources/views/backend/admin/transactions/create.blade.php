@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Add Transaction</h1>

    <form action="{{ route('backend.admin.transactions.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Invoice -->
        <input type="text" name="invoice" value="{{ old('invoice') }}" placeholder="Invoice" 
               class="w-full border p-2" required>
        @error('invoice') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Customer -->
        <select name="customer_id" class="w-full border p-2" required>
            <option value="">-- Select Customer --</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Date -->
        <input type="date" name="date" value="{{ old('date') }}" class="w-full border p-2" required>
        @error('date') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Total -->
        <input type="number" name="total" value="{{ old('total') }}" placeholder="Total" class="w-full border p-2" required>
        @error('total') <p class="text-red-500">{{ $message }}</p> @enderror

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Save Transaction
        </button>
    </form>
</div>
@endsection
