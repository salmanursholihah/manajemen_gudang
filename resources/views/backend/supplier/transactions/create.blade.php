@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Tambah Transaksi Supplier</h2>

    <form action="{{ route('backend.supplier.transactions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Invoice -->
        <div>
            <label class="block font-medium">Invoice</label>
            <input type="text" name="invoice" value="{{ old('invoice') }}" class="w-full border p-2 rounded">
            @error('invoice') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Customer -->
        <div>
            <label class="block font-medium">Customer</label>
            <select name="customer_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
            @error('customer_id') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Type -->
        <div>
            <label class="block font-medium">Tipe Transaksi</label>
            <select name="type" class="w-full border p-2 rounded">
                <option value="">-- Pilih Type --</option>
                <option value="pembelian" {{ old('type') == 'pembelian' ? 'selected' : '' }}>Pembelian</option>
                <option value="pembayaran" {{ old('type') == 'pembayaran' ? 'selected' : '' }}>Pembayaran</option>
            </select>
            @error('type') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Date -->
        <div>
            <label class="block font-medium">Tanggal</label>
            <input type="date" name="date" value="{{ old('date') }}" class="w-full border p-2 rounded">
            @error('date') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Produk & Jumlah -->
        <div>
            <label class="block font-medium">Produk & Jumlah</label>
            <div id="product-list">
                <div class="flex gap-2 mb-2">
                    <select name="products[]" class="w-1/2 border p-2 rounded">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Rp{{ number_format($product->price) }})</option>
                        @endforeach
                    </select>
                    <input type="number" name="quantities[]" min="1" value="1" class="w-1/4 border p-2 rounded">
                </div>
            </div>
            <button type="button" onclick="addProductRow()" class="bg-blue-500 text-white px-3 py-1 rounded">+ Produk</button>
            @error('products') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Document Supplier -->
        <div>
            <label class="block font-medium">Dokumen Supplier</label>
            <input type="file" name="document_supplier" class="w-full border p-2 rounded">
            @error('document_supplier') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>

<script>
function addProductRow() {
    const container = document.getElementById('product-list');
    const row = document.createElement('div');
    row.classList.add('flex', 'gap-2', 'mb-2');
    row.innerHTML = `
        <select name="products[]" class="w-1/2 border p-2 rounded">
            <option value="">-- Pilih Produk --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} (Rp{{ number_format($product->price) }})</option>
            @endforeach
        </select>
        <input type="number" name="quantities[]" min="1" value="1" class="w-1/4 border p-2 rounded">
    `;
    container.appendChild(row);
}
</script>
@endsection
