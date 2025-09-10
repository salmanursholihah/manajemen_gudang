@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Settings</h1>
        <a href="{{ route('backend.admin.settings.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Add Setting</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Key</th>
                    <th class="px-4 py-2 border">Value</th>
                    <th class="px-4 py-2 border">Type</th>
                    <th class="px-4 py-2 border">Group</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($settings as $setting)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $setting->key }}</td>
                    <td class="px-4 py-2 border">
                        @if($setting->type === 'image' && $setting->value)
                            <img src="{{ asset('storage/'.$setting->value) }}" class="w-20 h-20 rounded">
                        @elseif($setting->type === 'color')
                            <div class="w-8 h-8 rounded" style="background: {{ $setting->value }}"></div>
                        @else
                            {{ $setting->value }}
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $setting->type }}</td>
                    <td class="px-4 py-2 border">{{ $setting->group }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('backend.admin.settings.edit', $setting) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('backend.admin.settings.destroy', $setting) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
