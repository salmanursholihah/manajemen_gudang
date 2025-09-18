@extends('layouts.app')

@section('title', 'Report Transaksi')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Report Transaksi</h1>

    <!-- Filter -->
    <form method="GET" action="{{ route('reports.transactions') }}" class="flex gap-4 mb-6">
        <div>
            <label>Bulan</label>
            <input type="month" name="month" value="{{ request('month') }}" class="border rounded px-2 py-1">
        </div>
        <div>
            <label>Status</label>
            <select name="status" class="border rounded px-2 py-1">
                <option value="">-- Semua --</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
                <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('reports.transactions.export', request()->all()) }}" class="bg-green-500 text-white px-4 py-2 rounded">Export Excel</a>
    </form>

    <!-- Table -->
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-3 py-2">Invoice</th>
                <th class="border px-3 py-2">User</th>
                <th class="border px-3 py-2">Supplier</th>
                <th class="border px-3 py-2">Total</th>
                <th class="border px-3 py-2">Tanggal</th>
                <th class="border px-3 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $trx)
                <tr>
                    <td class="border px-3 py-2">{{ $trx->invoice }}</td>
                    <td class="border px-3 py-2">{{ $trx->user->name ?? '-' }}</td>
                    <td class="border px-3 py-2">{{ $trx->supplier->name ?? '-' }}</td>
                    <td class="border px-3 py-2">{{ number_format($trx->total,0,',','.') }}</td>
                    <td class="border px-3 py-2">{{ $trx->date }}</td>
                    <td class="border px-3 py-2">{{ ucfirst($trx->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $transactions->withQueryString()->links() }}
    </div>
</div>
@endsection
