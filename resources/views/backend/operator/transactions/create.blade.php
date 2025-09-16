@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Create Transaction</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.operator.transactions.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        {{-- Invoice --}}
        <div class="mb-4">
            <label class="block text-gray-700">Invoice</label>
            <input type="text" name="invoice"
                   value="{{ old('invoice') }}"
                   class="w-full border rounded px-3 py-2 mt-1">
        </div>

        {{-- Customer --}}
        <div class="mb-4">
            <label class="block text-gray-700">Customer</label>
            <select name="customer_id" class="w-full border rounded px-3 py-2 mt-1">
                <option value="">-- Pilih Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Supplier --}}
        <div class="mb-4">
            <label class="block text-gray-700">Supplier</label>
            <select name="supplier_id" class="w-full border rounded px-3 py-2 mt-1">
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Type --}}
        <div class="mb-4">
            <label class="block text-gray-700">Type</label>
            <select name="type" class="w-full border rounded px-3 py-2 mt-1">
                <option value="pembelian" {{ old('type') == 'pembelian' ? 'selected' : '' }}>Pembelian</option>
                <option value="pembayaran" {{ old('type') == 'pembayaran' ? 'selected' : '' }}>Pembayaran</option>
                <option value="mutation" {{ old('type') == 'mutation' ? 'selected' : '' }}>Mutation</option>
            </select>
        </div>

        {{-- Date --}}
        <div class="mb-4">
            <label class="block text-gray-700">Date</label>
            <input type="date" name="date"
                   value="{{ old('date') }}"
                   class="w-full border rounded px-3 py-2 mt-1">
        </div>

        {{-- Produk + Quantity (dinamis) --}}
        <div id="product-list" class="mb-4">
            <label class="block text-gray-700 mb-2">Produk</label>
            <div class="flex items-center gap-2 mb-2">
                <select name="products[]" class="w-1/2 border rounded px-3 py-2">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} (Rp {{ number_format($product->price,0,',','.') }})
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantities[]" value="1" min="1"
                       class="w-1/4 border rounded px-3 py-2">
                <button type="button" onclick="addProductRow()" class="bg-green-500 text-white px-3 py-1 rounded">+</button>
            </div>
        </div>

        {{-- Upload Dokumen --}}
        <div class="mb-4">
            <label class="block text-gray-700">Upload Document Operator</label>
            <input type="file" name="document_operator" class="w-full border rounded px-3 py-2 mt-1">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </div>
    </form>
</div>

{{-- JS untuk tambah produk dinamis --}}
<script>
function addProductRow() {
    const container = document.getElementById('product-list');
    const newRow = document.createElement('div');
    newRow.className = "flex items-center gap-2 mb-2";
    newRow.innerHTML = `
        <select name="products[]" class="w-1/2 border rounded px-3 py-2">
            <option value="">-- Pilih Produk --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }} (Rp {{ number_format($product->price,0,',','.') }})
                </option>
            @endforeach
        </select>
        <input type="number" name="quantities[]" value="1" min="1" class="w-1/4 border rounded px-3 py-2">
        <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 text-white px-3 py-1 rounded">-</button>
    `;
    container.appendChild(newRow);
}
</script>
@endsection
