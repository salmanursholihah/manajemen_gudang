<h2>Report Transaksi</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>Invoice</th><th>Customer</th><th>Supplier</th><th>User</th>
            <th>Tipe</th><th>Total</th><th>Tanggal</th><th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $trx)
        <tr>
            <td>{{ $trx->invoice }}</td>
            <td>{{ $trx->customer->name ?? '-' }}</td>
            <td>{{ $trx->supplier->name ?? '-' }}</td>
            <td>{{ $trx->user->name ?? '-' }}</td>
            <td>{{ $trx->type }}</td>
            <td>{{ number_format($trx->total,0,',','.') }}</td>
            <td>{{ $trx->date }}</td>
            <td>{{ $trx->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
