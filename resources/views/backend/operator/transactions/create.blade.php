@extends('layouts.app')
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">
        {{ isset($transaction) ? 'Edit Transaction' : 'Add Transaction' }}
    </h1>

    <form action="{{ isset($transaction) ? route('backend.operator.transactions.update', $transaction->id) : route('backend.operator.transactions.store') }}" method="POST">
        @csrf
        @if(isset($transaction)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            {{-- Invoice --}}
            <div>
                <label class="block text-gray-700">Invoice</label>
                <input type="text" name="invoice" value="{{ old('invoice', $transaction->invoice ?? '') }}" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-gray-700">Type</label>
                <select name="type" class="w-full border rounded px-3 py-2 mt-1" required>
                    <option value="pembelian" {{ old('type', $transaction->type ?? '')=='pembelian' ? 'selected' : '' }}>Inbound</option>
                    <option value="pembayaran" {{ old('type', $transaction->type ?? '')=='pembayaran' ? 'selected' : '' }}>Outbound</option>
                </select>
            </div>

            {{-- Customer --}}
            <div>
                <label class="block text-gray-700">Customer</label>
                <select name="customer_id" class="w-full border rounded px-3 py-2 mt-1">
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $transaction->customer_id ?? '')==$customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Supplier --}}
            <div>
                <label class="block text-gray-700">Supplier</label>
                <select name="supplier_id" class="w-full border rounded px-3 py-2 mt-1">
                    <option value="">-- Select Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $transaction->supplier_id ?? '')==$supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Products --}}
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Products</label>
            <div id="products-wrapper" class="space-y-2">
                @if(isset($transaction))
                    @foreach($transaction->items as $item)
                    <div class="flex gap-2 items-center">
                        <select name="products[]" class="border rounded px-3 py-2 w-2/3" required>
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $item->product_id==$product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="quantities[]" value="{{ $item->quantity }}" class="border rounded px-3 py-2 w-1/6" min="1" required>
                        <button type="button" class="px-3 py-1 bg-red-500 text-white rounded remove-product">Remove</button>
                    </div>
                    @endforeach
                @else
                    <div class="flex gap-2 items-center">
                        <select name="products[]" class="border rounded px-3 py-2 w-2/3" required>
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="quantities[]" class="border rounded px-3 py-2 w-1/6" min="1" required>
                        <button type="button" class="px-3 py-1 bg-red-500 text-white rounded remove-product">Remove</button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-product" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Add Product</button>
        </div>

        {{-- Date --}}
        <div class="mb-4">
            <label class="block text-gray-700">Date</label>
            <input type="date" name="date" value="{{ old('date', isset($transaction) ? $transaction->date->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                {{ isset($transaction) ? 'Update' : 'Save' }}
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-product').addEventListener('click', function() {
        const wrapper = document.getElementById('products-wrapper');
        const div = document.createElement('div');
        div.classList.add('flex', 'gap-2', 'items-center');
        div.innerHTML = `
            <select name="products[]" class="border rounded px-3 py-2 w-2/3" required>
                <option value="">-- Select Product --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <input type="number" name="quantities[]" class="border rounded px-3 py-2 w-1/6" min="1" required>
            <button type="button" class="px-3 py-1 bg-red-500 text-white rounded remove-product">Remove</button>
        `;
        wrapper.appendChild(div);
    });

    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-product')) {
            e.target.parentElement.remove();
        }
    });
</script>
@endsection













