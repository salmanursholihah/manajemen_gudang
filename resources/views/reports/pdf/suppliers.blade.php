<h2>Report Supplier</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr><th>ID</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Alamat</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->phone }}</td>
            <td>{{ $s->address }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
