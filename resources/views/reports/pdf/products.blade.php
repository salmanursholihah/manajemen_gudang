<h2>Report Produk</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>ID</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stock</th><th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? '-' }}</td>
            <td>{{ number_format($product->price,0,',','.') }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
