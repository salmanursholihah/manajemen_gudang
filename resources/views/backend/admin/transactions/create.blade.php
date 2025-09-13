@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Transaksi (Admin)</h1>

    <form action="{{ route('backend.admin.transactions.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf

        {{-- Invoice --}}
        <div>
            <label for="invoice" class="block font-medium">Invoice</label>
            <input type="text" name="invoice" id="invoice" value="{{ old('invoice') }}"
                   class="w-full border rounded p-2 @error('invoice') border-red-500 @enderror" required>
            @error('invoice')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Customer --}}
        <div>
            <label for="customer_id" class="block font-medium">Customer (opsional)</label>
            <select name="customer_id" id="customer_id" class="w-full border rounded p-2">
                <option value="">-- Pilih Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Supplier --}}
        <div>
            <label for="supplier_id" class="block font-medium">Supplier (opsional)</label>
            <select name="supplier_id" id="supplier_id" class="w-full border rounded p-2">
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jenis Transaksi --}}
        <div>
            <label for="type" class="block font-medium">Jenis Transaksi</label>
            <select name="type" id="type" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="pembelian" {{ old('type') == 'pembelian' ? 'selected' : '' }}>Inbound (Barang Masuk)</option>
                <option value="pembayaran" {{ old('type') == 'pembayaran' ? 'selected' : '' }}>Outbound (Barang Keluar)</option>
                <option value="mutation" {{ old('type') == 'mutation' ? 'selected' : '' }}>Mutasi Internal</option>
            </select>
        </div>

        {{-- Total Barang --}}
        <div>
            <label for="total" class="block font-medium">Total Barang</label>
            <input type="number" name="total" id="total" value="{{ old('total') }}"
                   class="w-full border rounded p-2 @error('total') border-red-500 @enderror" required>
            @error('total')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div>
            <label for="date" class="block font-medium">Tanggal</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}"
                   class="w-full border rounded p-2 @error('date') border-red-500 @enderror" required>
            @error('date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block font-medium">Status</label>
            <select name="status" id="status" class="w-full border rounded p-2" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        {{-- Upload Dokumen --}}
        <div>
            <label for="document" class="block font-medium">Upload Dokumen (Opsional)</label>
            <input type="file" name="document" id="document"
                   class="w-full border rounded p-2 @error('document') border-red-500 @enderror">
            @error('document')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700">
            Simpan Transaksi
        </button>
    </form>
</div>
@endsection







