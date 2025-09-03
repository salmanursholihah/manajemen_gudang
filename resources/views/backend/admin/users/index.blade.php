@extends('layouts.app')
@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">User Management</h1>
        <a href="{{ route('backend.admin.users.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Add User</a>
    </div>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
        <tr>
            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
            <td class="px-4 py-2 border">{{ $user->name }}</td>
            <td class="px-4 py-2 border">{{ $user->email }}</td>
            <td class="px-4 py-2 border">{{ $user->role }}</td>
            <td class="px-4 py-2 border">
                <form action="{{ route('backend.admin.users.updateStatus', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="px-2 py-1 rounded {{ $user->status === 'Aktif' ? 'bg-green-500 text-white hover:bg-green-600' : 'bg-yellow-500 text-white hover:bg-yellow-600' }} transition-colors duration-200">
                        {{ $user->status }}
                    </button>
                </form>
            </td>
            <td class="px-4 py-2 border text-center space-x-2">
                <a href="{{ route('backend.admin.users.edit', $user) }}"
                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Edit</a>
                <form action="{{ route('backend.admin.users.destroy', $user) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

 <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
        <p>
            Menampilkan 
            {{ $users->firstItem() }} - {{ $users->lastItem() }} 
            dari {{ $users->total() }} produk
        </p>
        <div>
            {{ $users->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection