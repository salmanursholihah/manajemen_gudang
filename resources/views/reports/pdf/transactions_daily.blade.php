<h2>Report Transaksi per Hari</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr><th>Tanggal</th><th>Total Transaksi</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>{{ $row->day }}</td>
            <td>{{ $row->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
