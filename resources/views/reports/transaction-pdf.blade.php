<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi</h2>
    <a href="{{ route('reports.transactions.export', request()->all()) }}" 
   class="bg-green-500 text-white px-4 py-2 rounded">Export Excel</a>

<a href="{{ route('reports.transactions.export.pdf', request()->all()) }}" 
   class="bg-red-500 text-white px-4 py-2 rounded">Export PDF</a>

    <table>
        <thead>
            <tr>
                <th>Invoice</th>
                <th>User</th>
                <th>Supplier</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td>{{ $trx->invoice }}</td>
                <td>{{ $trx->user->name ?? '-' }}</td>
                <td>{{ $trx->supplier->name ?? '-' }}</td>
                <td>{{ number_format($trx->total,0,',','.') }}</td>
                <td>{{ $trx->date }}</td>
                <td>{{ ucfirst($trx->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
