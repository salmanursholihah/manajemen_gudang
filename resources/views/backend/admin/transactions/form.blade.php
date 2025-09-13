@extends('layouts.app')
@section('content')
<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ isset($transaction) ? 'Edit' : 'Create' }} Transaction</h1>

    <form action="{{ isset($transaction) ? route('backend.admin.transactions.update', $transaction) : route('backend.admin.transactions.store') }}" method="POST">
        @csrf
        @if(isset($transaction))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block font-medium">Invoice</label>
            <input type="text" name="invoice" class="w-full border px-3 py-2 rounded" value="{{ $transaction->invoice ?? '' }}" required>
        </div>

        <div class="mb-4 flex space-x-2">
            <div class="w-1/2">
                <label class="block font-medium">Customer</label>
                <select name="customer_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">-- Pilih Customer --</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}" @if(isset($transaction) && $transaction->customer_id==$c->id) selected @endif>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/2">
                <label class="block font-medium">Supplier</label>
                <select name="supplier_id" class="w-full border px-3 py-2 rounded">
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $s)
                        <option value="{{ $s->id }}" @if(isset($transaction) && $transaction->supplier_id==$s->id) selected @endif>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Type</label>
            <select name="type" class="w-full border px-3 py-2 rounded" required>
                <option value="pembelian" @if(isset($transaction) && $transaction->type=='pembelian') selected @endif>Inbound</option>
                <option value="pembayaran" @if(isset($transaction) && $transaction->type=='pembayaran') selected @endif>Outbound</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded" required>
                <option value="pending" @if(isset($transaction) && $transaction->status=='pending') selected @endif>Pending</option>
                <option value="approved" @if(isset($transaction) && $transaction->status=='approved') selected @endif>Approved</option>
                <option value="rejected" @if(isset($transaction) && $transaction->status=='rejected') selected @endif>Rejected</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Date</label>
            <input type="date" name="date" class="w-full border px-3 py-2 rounded" value="{{ $transaction->date ?? '' }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Products</label>
            <div id="products-wrapper">
                @if(isset($transaction))
                    @foreach($transaction->items as $i => $item)
                        <div class="flex space-x-2 mb-2 product-row">
                            <select name="products[{{ $i }}][id]" class="border px-2 py-1 rounded" required>
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}" @if($prod->id==$item->product_id) selected @endif>{{ $prod->name }} ({{ $prod->satuan }})</option>
                                @endforeach
                            </select>
                            <input type="number" name="products[{{ $i }}][quantity]" class="border px-2 py-1 rounded w-20" min="1" value="{{ $item->quantity }}" required>
                            <button type="button" class="bg-red-500 text-white px-2 rounded remove-row">Hapus</button>
                        </div>
                    @endforeach
                @else
                    <div class="flex space-x-2 mb-2 product-row">
                        <select name="products[0][id]" class="border px-2 py-1 rounded" required>
                            @foreach($products as $prod)
                                <option value="{{ $prod->id }}">{{ $prod->name }} ({{ $prod->satuan }})</option>
                            @endforeach
                        </select>
                        <input type="number" name="products[0][quantity]" class="border px-2 py-1 rounded w-20" min="1" placeholder="Qty" required>
                        <button type="button" class="bg-red-500 text-white px-2 rounded remove-row">Hapus</button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-product" class="bg-blue-500 text-white px-3 py-1 rounded">Tambah Produk</button>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">{{ isset($transaction) ? 'Update' : 'Create' }} Transaction</button>
    </form>
</div>

<script>
let productIndex = {{ isset($transaction) ? count($transaction->items) : 1 }};
document.getElementById('add-product').addEventListener('click', function(){
    let wrapper = document.getElementById('products-wrapper');
    let row = document.querySelector('.product-row').cloneNode(true);
    row.querySelectorAll('select,input').forEach(el => {
        let name = el.getAttribute('name').replace(/\d+/, productIndex);
        el.setAttribute('name', name);
        el.value = '';
    });
    wrapper.appendChild(row);
    productIndex++;
});

document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-row')){
        let rows = document.querySelectorAll('.product-row');
        if(rows.length > 1){
            e.target.closest('.product-row').remove();
        }
    }
});
</script>
@endsection
