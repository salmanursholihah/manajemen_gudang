@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Buat Transaksi</h1>

<form action="{{ route('backend.operator.transactions.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Invoice</label>
        <input type="text" name="invoice" class="border rounded px-2 py-1 w-full" required>
    </div>

    <div class="mb-3">
        <label>Type</label>
        <select name="type" class="border rounded px-2 py-1 w-full" required>
            <option value="pembelian">Inbound (Pembelian)</option>
            <option value="pembayaran">Outbound (Pembayaran)</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Customer</label>
        <select name="customer_id" class="border rounded px-2 py-1 w-full">
            <option value="">-- Pilih Customer --</option>
            @foreach($customers as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Supplier</label>
        <select name="supplier_id" class="border rounded px-2 py-1 w-full">
            <option value="">-- Pilih Supplier --</option>
            @foreach($suppliers as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="date" class="border rounded px-2 py-1 w-full" required>
    </div>

    <div class="mb-3">
        <label>Produk</label>
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Produk</th>
                    <th class="p-2 border">Stock</th>
                    <th class="p-2 border">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="p-2 border">{{ $product->name }}</td>
                    <td class="p-2 border">{{ $product->quantity }}</td>
                    <td class="p-2 border">
                        <input type="number" min="0" max="{{ $product->quantity }}" name="products[{{ $loop->index }}][quantity]" class="border rounded px-2 py-1 w-full">
                        <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan Transaksi</button>
</form>
</div>
@endsection