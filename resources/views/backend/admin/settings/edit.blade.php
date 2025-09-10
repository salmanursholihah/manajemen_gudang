@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">
        {{ isset($setting) ? 'Edit Setting' : 'Add Setting' }}
    </h1>

    <form action="{{ isset($setting) ? route('backend.admin.settings.update', $setting) : route('backend.admin.settings.store') }}" 
          method="POST" class="space-y-4">
        @csrf
        @if(isset($setting)) @method('PUT') @endif

        <input type="text" name="key" value="{{ old('key', $setting->key ?? '') }}" 
               placeholder="Key" class="w-full border p-2" required>
        @error('key') <p class="text-red-500">{{ $message }}</p> @enderror

        <textarea name="value" class="w-full border p-2" placeholder="Value" required>{{ old('value', $setting->value ?? '') }}</textarea>
        @error('value') <p class="text-red-500">{{ $message }}</p> @enderror

        <input type="text" name="type" value="{{ old('type', $setting->type ?? '') }}" 
               placeholder="Type" class="w-full border p-2" required>
        @error('type') <p class="text-red-500">{{ $message }}</p> @enderror

        <input type="text" name="group" value="{{ old('group', $setting->group ?? '') }}" 
               placeholder="Group" class="w-full border p-2" required>
        @error('group') <p class="text-red-500">{{ $message }}</p> @enderror

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            {{ isset($setting) ? 'Update' : 'Save' }}
        </button>
    </form>
</div>
@endsection
