<h2>Report Transaksi per Bulan</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr><th>Tahun</th><th>Bulan</th><th>Total Transaksi</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>{{ $row->year }}</td>
            <td>{{ $row->month }}</td>
            <td>{{ $row->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
