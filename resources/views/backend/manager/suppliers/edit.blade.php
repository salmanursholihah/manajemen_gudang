@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Edit Supplier</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 mb-6 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.manager.suppliers.update', $supplier->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name', $supplier->name) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $supplier->email) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Address</label>
            <textarea name="address" class="w-full border p-2 rounded">{{ old('address', $supplier->address) }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Current Image</label>
            @if ($supplier->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $supplier->image) }}" alt="Supplier Image" class="w-32 h-32 object-cover rounded">
                </div>
            @endif
            <label class="block font-medium">Change Image</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update Supplier</button>
        </div>
    </form>
</div>
@endsection
