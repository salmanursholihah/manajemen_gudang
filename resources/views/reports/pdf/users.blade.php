<h2>Report User</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->role }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
