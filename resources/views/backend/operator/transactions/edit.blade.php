@extends('layouts.app')

@section('content')
<div class="p-6 max-w-lg mx-auto bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">Edit Transaksi</h1>

    <form method="POST" action="{{ route('backend.operator.transactions.update', $transaction->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Invoice</label>
            <input type="text" name="invoice" value="{{ old('invoice', $transaction->invoice) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Total</label>
            <input type="number" name="total" value="{{ old('total', $transaction->total) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Tanggal</label>
            <input type="date" name="date" value="{{ old('date', $transaction->date) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $transaction->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $transaction->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>
</div>
@endsection
