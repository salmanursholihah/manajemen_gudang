@extends('layouts.app')
@section('content')
<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Create Draft Inbound Transaction</h1>

    <form action="{{ route('backend.supplier.transactions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Invoice</label>
            <input type="text" name="invoice" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Customer</label>
            <select name="customer_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Customer --</option>
                @foreach($customers as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Products</label>
            <div id="products-wrapper">
                <div class="flex space-x-2 mb-2 product-row">
                    <select name="products[0][id]" class="border px-2 py-1 rounded" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $prod)
                            <option value="{{ $prod->id }}">{{ $prod->name }} ({{ $prod->satuan }})</option>
                        @endforeach
                    </select>
                    <input type="number" name="products[0][quantity]" class="border px-2 py-1 rounded w-20" min="1" placeholder="Qty" required>
                    <button type="button" class="bg-red-500 text-white px-2 rounded remove-row">Hapus</button>
                </div>
            </div>
            <button type="button" id="add-product" class="bg-blue-500 text-white px-3 py-1 rounded">Tambah Produk</button>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Upload Dokumen (Invoice / DO)</label>
            <input type="file" name="documents[]" multiple class="border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Submit Draft</button>
    </form>
</div>

<script>
let productIndex = 1;
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
