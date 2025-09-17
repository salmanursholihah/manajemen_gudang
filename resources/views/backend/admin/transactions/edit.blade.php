@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Edit Transaction</h2>

    <form action="{{ route('backend.admin.transactions.update', $transaction->id) }}" 
          method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Invoice --}}
        <div>
            <label for="invoice" class="block font-medium">Invoice</label>
            <input type="text" name="invoice" id="invoice" 
                   value="{{ old('invoice', $transaction->invoice) }}" 
                   class="w-full border rounded p-2">
            @error('invoice')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Customer --}}
        <div>
            <label for="customer_id" class="block font-medium">Customer</label>
            <select name="customer_id" id="customer_id" class="w-full border rounded p-2">
                <option value="">-- pilih customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" 
                        {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Supplier --}}
        <div>
            <label for="supplier_id" class="block font-medium">Supplier</label>
            <select name="supplier_id" id="supplier_id" class="w-full border rounded p-2">
                <option value="">-- pilih supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" 
                        {{ old('supplier_id', $transaction->supplier_id) == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
            @error('supplier_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Type --}}
        <div>
            <label for="type" class="block font-medium">Type</label>
            <select name="type" id="type" class="w-full border rounded p-2">
                <option value="pembelian" {{ old('type', $transaction->type) == 'pembelian' ? 'selected' : '' }}>Pembelian</option>
                <option value="pembayaran" {{ old('type', $transaction->type) == 'pembayaran' ? 'selected' : '' }}>Pembayaran</option>
                <option value="mutation" {{ old('type', $transaction->type) == 'mutation' ? 'selected' : '' }}>Mutation</option>
            </select>
            @error('type')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Total --}}
        <div>
            <label for="total" class="block font-medium">Total</label>
            <input type="number" name="total" id="total" 
                   value="{{ old('total', $transaction->total) }}" 
                   class="w-full border rounded p-2">
            @error('total')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Date --}}
        <div>
            <label for="date" class="block font-medium">Date</label>
            <input type="date" name="date" id="date" 
                   value="{{ old('date', $transaction->date) }}" 
                   class="w-full border rounded p-2">
            @error('date')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block font-medium">Status</label>
            <select name="status" id="status" class="w-full border rounded p-2">
                <option value="draft" {{ old('status', $transaction->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="pending" {{ old('status', $transaction->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ old('status', $transaction->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ old('status', $transaction->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Document --}}
        <div>
            <label for="document" class="block font-medium">Document</label>
            <input type="file" name="document" id="document" class="w-full border rounded p-2">
            @if($transaction->document)
                <p class="mt-2 text-sm text-gray-600">Current file: 
                    <a href="{{ asset('storage/'.$transaction->document) }}" target="_blank" class="text-blue-500 underline">
                        {{ basename($transaction->document) }}
                    </a>
                </p>
            @endif
            @error('document')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Update Transaction
            </button>
        </div>
    </form>
</div>
@endsection
