<h2>Report Produk per Kategori</h2>
@foreach ($data as $category => $products)
    <h3>Kategori: {{ $category }}</h3>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr>
                <th>ID</th><th>Nama</th><th>Harga</th><th>Stock</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ number_format($p->price,0,',','.') }}</td>
                <td>{{ $p->stock }}</td>
                <td>{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
