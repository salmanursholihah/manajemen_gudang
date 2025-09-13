@extends('layouts.app')
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Transaction Details</h1>

    <div class="bg-white rounded shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="font-semibold">Invoice:</p>
                <p>{{ $transaction->invoice }}</p>
            </div>
            <div>
                <p class="font-semibold">Type:</p>
                <p>{{ ucfirst($transaction->type) }}</p>
            </div>
            <div>
                <p class="font-semibold">Customer:</p>
                <p>{{ $transaction->customer->name ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Supplier:</p>
                <p>{{ $transaction->supplier->name ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Date:</p>
                <p>{{ $transaction->date instanceof \Carbon\Carbon ? $transaction->date->format('Y-m-d') : $transaction->date }}</p>
            </div>
            <div>
                <p class="font-semibold">Total:</p>
                <p>Rp {{ number_format($transaction->total,0,',','.') }}</p>
            </div>
            <div class="col-span-2">
                <p class="font-semibold">Status:</p>
                @if($transaction->status == 'approved')
                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Approved</span>
                @elseif($transaction->status == 'rejected')
                    <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Rejected</span>
                @else
                    <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Pending</span>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded shadow p-6 mb-6">
        <h2 class="font-semibold mb-2">Products</h2>
        <ul class="list-disc pl-5">
            @foreach($transaction->items as $item)
                <li>
                    {{ $item->product->name ?? '-' }} - Quantity: {{ $item->quantity }} {{ $item->product->satuan ?? '' }}
                </li>
            @endforeach
        </ul>
    </div>

    @if($transaction->status == 'pending')
    <div class="flex gap-4">
        <form action="{{ route('backend.manager.transactions.approve', $transaction->id) }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Approve</button>
        </form>

        <form action="{{ route('backend.manager.transactions.reject', $transaction->id) }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Reject</button>
        </form>
    </div>
    @endif
</div>
@endsection
