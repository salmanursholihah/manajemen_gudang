@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Create customer</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 mb-6 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{ route('backend.admin.customers.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-medium">Nama Customer</label>
            <input type="text" name="name" id="name" class="w-full border p-2 rounded" value="{{ old('name') }}"
                required>
        </div>

        <div>
            <label for="email" class="block font-medium">Email</label>
            <input type="email" name="email" id="email" class="w-full border p-2 rounded" value="{{ old('email') }}"
                required>
        </div>

        <div>
            <label for="phone" class="block font-medium">No. Telepon</label>
            <input type="text" name="phone" id="phone" class="w-full border p-2 rounded" value="{{ old('phone') }}"
                required>
        </div>

        <div>
            <label for="address" class="block font-medium">Alamat</label>
            <textarea name="address" id="address" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm"
                required>{{ old('address') }}</textarea>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('backend.admin.customers.index') }}"
                class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection