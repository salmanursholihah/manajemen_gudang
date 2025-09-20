<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Rejected</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi Ditolak</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Supplier</th>
                <th>User</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $trx)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $trx->code ?? '-' }}</td>
                    <td>{{ $trx->date ?? '-' }}</td>
                    <td>{{ $trx->customer->name ?? '-' }}</td>
                    <td>{{ $trx->supplier->name ?? '-' }}</td>
                    <td>{{ $trx->user->name ?? '-' }}</td>
                    <td>{{ ucfirst($trx->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
