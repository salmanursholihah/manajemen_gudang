<h2>Report Compare Transaksi Operator vs Supplier</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>Invoice</th><th>Operator</th><th>Supplier</th><th>Total</th><th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $trx)
        <tr>
            <td>{{ $trx->invoice }}</td>
            <td>{{ $trx->operator->name ?? '-' }}</td>
            <td>{{ $trx->supplier->name ?? '-' }}</td>
            <td>{{ number_format($trx->total,0,',','.') }}</td>
            <td>{{ $trx->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
