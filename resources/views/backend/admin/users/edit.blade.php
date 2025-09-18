@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Edit User</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 mb-6 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Password (leave blank to keep current)</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Role</label>
            <select name="role" class="w-full border p-2 rounded">
                <option value="Admin" {{ old('role', $user->role)=='Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Manager" {{ old('role', $user->role)=='Manager' ? 'selected' : '' }}>Manager</option>
                <option value="Operator" {{ old('role', $user->role)=='Operator' ? 'selected' : '' }}>Operator</option>
                <option value="supplier" {{ old('role', $user->role)=='supplier' ? 'selected' : '' }}>supplier</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Current Image</label>
            @if ($user->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="w-32 h-32 object-cover rounded">
                </div>
            @endif
            <label class="block font-medium">Change Image</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update User</button>
        </div>
    </form>
</div>
@endsection
