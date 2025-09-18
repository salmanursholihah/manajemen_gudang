<h2>Report Customer</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr><th>ID</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Alamat</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->name }}</td>
            <td>{{ $c->email }}</td>
            <td>{{ $c->phone }}</td>
            <td>{{ $c->address }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
