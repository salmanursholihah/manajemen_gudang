@extends('layouts.app')

@section('content')
<div class="p-6 max-w-6xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Outbound Transactions</h1>
        <a href="{{ route('backend.operator.outbound.create') }}"
           class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
           ➕ Add Outbound Stock
        </a>
    </div>

    <!-- Table Outbound -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Invoice</th>
                    <th class="p-2 border">Supplier</th>
                    <th class="p-2 border">Total</th>
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($outbounds as $trx)
                    <tr>
                        <td class="p-2 border">{{ $loop->iteration }}</td>
                        <td class="p-2 border">{{ $trx->invoice }}</td>
                        <td class="p-2 border">{{ $trx->supplier->name ?? '-' }}</td>
                        <td class="p-2 border">Rp {{ number_format($trx->total,0,',','.') }}</td>
                        <td class="p-2 border">{{ $trx->date }}</td>
                        <td class="p-2 border">
                            @if($trx->status=='approved')
                                <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Approved</span>
                            @elseif($trx->status=='rejected')
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Rejected</span>
                            @else
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-3 text-center text-gray-500">Tidak ada transaksi outbound</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $outbounds->links() }}
    </div>

</div>
@endsection
