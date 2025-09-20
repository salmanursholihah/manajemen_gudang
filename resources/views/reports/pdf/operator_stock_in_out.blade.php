<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang Masuk & Keluar</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Barang Masuk & Keluar</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Produk</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $trx)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $trx->code ?? '-' }}</td>
                    <td>{{ $trx->date ?? '-' }}</td>
                    <td>{{ ucfirst($trx->type) }}</td>
                    <td>{{ $trx->product->name ?? '-' }}</td>
                    <td>{{ $trx->quantity ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
