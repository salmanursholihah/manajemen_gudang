<h2>Report Transaksi per User</h2>
@foreach ($data as $user => $trxs)
    <h3>User: {{ $user }}</h3>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr><th>Invoice</th><th>Tanggal</th><th>Total</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach ($trxs as $trx)
            <tr>
                <td>{{ $trx->invoice }}</td>
                <td>{{ $trx->date }}</td>
                <td>{{ number_format($trx->total,0,',','.') }}</td>
                <td>{{ $trx->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
