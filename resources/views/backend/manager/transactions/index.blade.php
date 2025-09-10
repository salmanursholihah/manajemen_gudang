@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Transactions</h1>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Invoice</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Total</th>
                    <th class="px-4 py-2 text-left">status</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr class="hover:bg-gray-50 border-t">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $transaction->invoice }}</td>
                    <td class="px-4 py-2">
                        {{-- jika sudah ada relasi ke Customer model --}}
                        {{ $transaction->customer->name ?? $transaction->customer_id }}
                    </td>
                    <td class="px-4 py-2">{{ $transaction->date }}</td>
                    <td class="px-4 py-2">
                        <span
                            class="px-2 py-1 text-xs rounded 
                {{ $transaction->type === 'pembelian' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ number_format($transaction->total, 0, ',', '.') }}</td>

                    <td class="p-3">
                        @if($transaction->status == 'approved')
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Approved</span>
                        @elseif($transaction->status == 'rejected')
                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Rejected</span>
                        @else
                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Pending</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center space-x-2">
                              @if($transaction->status != 'approved')
                        <form action="{{ route('backend.manager.transactions.approve', $transaction->id) }}" 
                              method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    Approve
                            </button>
                        </form>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                        No transactions available
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
    
 <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
        <p>
            Menampilkan 
            {{ $transactions->firstItem() }} - {{ $transactions->lastItem() }} 
            dari {{ $transactions->total() }} produk
        </p>
        <div>
            {{ $transactions->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection