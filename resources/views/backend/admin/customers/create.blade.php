@extends('layouts.backend')

@section('title', 'Create User')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Create User</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 mb-6 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Password</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Role</label>
            <select name="role" class="w-full border p-2 rounded">
                <option value="Admin" {{ old('role')=='Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Manager" {{ old('role')=='Manager' ? 'selected' : '' }}>Manager</option>
                <option value="Operator" {{ old('role')=='Operator' ? 'selected' : '' }}>Operator</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Image</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create User</button>
        </div>
    </form>
</div>
@endsection
