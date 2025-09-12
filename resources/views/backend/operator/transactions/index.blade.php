@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Header -->
    <!-- <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Transaksi</h1> -->
        <!-- <div class="space-x-2">
            <a href="{{ route('backend.operator.transactions.inbound.create') }}"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">+ Inbound</a>
            <a href="{{ route('backend.operator.transactions.outbound.create') }}"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">+ Outbound</a>
        </div> -->
          <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Transactions</h1>
        <a href="{{ route('backend.operator.transactions.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            + Add Transaction</a>
    </div>
    </div>

    <!-- Filter -->
    <form method="GET" class="mb-4 flex space-x-2">
        <select name="type" class="border rounded px-2 py-1">
            <option value="">Semua</option>
            <option value="pembelian" {{ request('type')=='pembelian' ? 'selected' : '' }}>Inbound (Pembelian)</option>
            <option value="pembayaran" {{ request('type')=='pembayaran' ? 'selected' : '' }}>Outbound (Pembayaran)</option>
        </select>
        <button class="bg-blue-600 text-white px-3 rounded">Filter</button>
    </form>

    <!-- Table Responsive -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Invoice</th>
                    <th class="p-2 border">Type</th>
                    <th class="p-2 border">Customer</th>
                    <th class="p-2 border">Supplier</th>
                    <th class="p-2 border">Total</th>
                    <th class="p-2 border">Tanggal</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Produk</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td class="p-2 border">{{ $loop->iteration }}</td>
                    <td class="p-2 border">{{ $trx->invoice }}</td>
                    <td class="p-2 border">
                        @if($trx->type == 'pembelian')
                            <span class="bg-green-200 text-green-700 px-2 py-1 rounded text-sm">Inbound</span>
                        @else
                            <span class="bg-red-200 text-red-700 px-2 py-1 rounded text-sm">Outbound</span>
                        @endif
                    </td>
                    <td class="p-2 border">{{ $trx->customer->name ?? '-' }}</td>
                    <td class="p-2 border">{{ $trx->supplier->name ?? '-' }}</td>
                    <td class="p-2 border">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                    <td class="p-2 border">{{ $trx->date }}</td>
                    <td class="p-2 border">
                        @if($trx->status == 'approved')
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Approved</span>
                        @elseif($trx->status == 'rejected')
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Rejected</span>
                        @else
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Pending</span>
                        @endif
                    </td>
                    <td class="p-2 border">
                        <ul class="list-disc pl-4">
                            @foreach($trx->items as $item)
                                <li>{{ $item->product->name ?? '-' }} ({{ $item->quantity }} {{ $item->product->satuan ?? '' }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="p-2 border">
                        <a href="{{ route('backend.operator.transactions.edit', $trx->id) }}"
                            class="px-2 py-1 bg-blue-600 text-white rounded text-sm">Edit</a>
                        <form action="{{ route('backend.operator.transactions.destroy', $trx->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded text-sm ml-1" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="p-3 text-center text-gray-500">Tidak ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
