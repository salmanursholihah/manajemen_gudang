@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Customers</h1>
    <a href="{{ route('backend.admin.customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Customer</a>

    <table class="min-w-full mt-4 border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Phone</th>
                <th class="px-4 py-2 border">Address</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                <td class="px-4 py-2 border">{{ $customer->name }}</td>
                <td class="px-4 py-2 border">{{ $customer->email }}</td>
                <td class="px-4 py-2 border">{{ $customer->phone }}</td>
                <td class="px-4 py-2 border">{{ $customer->address }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('backend.admin.customers.edit', $customer) }}" class="bg-green-500 text-white px-3 py-1 rounded">Edit</a>
                    <form action="{{ route('backend.admin.customers.destroy', $customer) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
