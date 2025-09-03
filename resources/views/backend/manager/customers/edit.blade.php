@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Edit Customer</h1>
    <form action="{{ route('backend.manager.customers.update', $customer) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $customer->name }}" class="w-full border p-2" required>
        <input type="email" name="email" value="{{ $customer->email }}" class="w-full border p-2" required>
        <input type="text" name="phone" value="{{ $customer->phone }}" class="w-full border p-2">
        <input type="text" name="address" value="{{ $customer->address }}" class="w-full border p-2">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
