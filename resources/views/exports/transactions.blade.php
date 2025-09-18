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
            <td>{{ $trx->total }}</td>
            <td>{{ $trx->date }}</td>
            <td>{{ $trx->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
