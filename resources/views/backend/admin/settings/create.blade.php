@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">{{ isset($setting) ? 'Edit Setting' : 'Add Setting' }}</h1>

    <form action="{{ isset($setting) ? route('backend.admin.settings.update', $setting) : route('backend.admin.settings.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($setting)) @method('PUT') @endif

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Key</label>
            <input type="text" name="key" value="{{ old('key', $setting->key ?? '') }}" 
                   class="border p-2 w-full rounded" {{ isset($setting) ? 'readonly' : '' }}>
            @error('key') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Type</label>
            <select name="type" class="border p-2 w-full rounded" {{ isset($setting) ? 'disabled' : '' }}>
                @foreach(['text','image','color'] as $type)
                    <option value="{{ $type }}" 
                        @if(old('type', $setting->type ?? '') === $type) selected @endif>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
            @error('type') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Group</label>
            <input type="text" name="group" value="{{ old('group', $setting->group ?? '') }}" 
                   class="border p-2 w-full rounded">
            @error('group') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Value</label>

            {{-- Preview jika image --}}
            @if(isset($setting) && $setting->type === 'image' && $setting->value)
                <img src="{{ asset('storage/'.$setting->value) }}" class="w-24 h-24 mb-2 rounded">
            @endif

            @if((isset($setting) && $setting->type === 'image') || old('type') === 'image')
                <input type="file" name="value" class="border p-2 w-full rounded">
            @elseif((isset($setting) && $setting->type === 'color') || old('type') === 'color')
                <input type="color" name="value" 
                       value="{{ old('value', $setting->value ?? '#000000') }}" 
                       class="border p-2 w-full rounded">
            @else
                <input type="text" name="value" 
                       value="{{ old('value', $setting->value ?? '') }}" 
                       class="border p-2 w-full rounded">
            @endif

            @error('value') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" 
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Save
        </button>
    </form>
</div>
@endsection
