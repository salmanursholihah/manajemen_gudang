@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">Tambah Landing Content</h2>

    <form action="{{ route('backend.admin.landings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Section --}}
        <div>
            <label for="section" class="block font-semibold mb-1">Section</label>
            <select name="section" id="section" class="w-full border rounded p-3">
                <option value="hero">Hero</option>
                <option value="fitur">Fitur</option>
                <option value="demo">Demo</option>
                <option value="integrasi">Integrasi</option>
                <option value="studi-kasus">Studi Kasus</option>
                <option value="testimoni">Testimoni</option>
                <option value="faq">FAQ</option>
                <option value="kontak">Kontak</option>
                <option value="footer">Footer</option>
            </select>
            @error('section') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Title --}}
        <div>
            <label for="title" class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" id="title" class="w-full border rounded p-3" value="{{ old('title') }}">
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Content --}}
        <div>
            <label for="content" class="block font-semibold mb-1">Content</label>
            <textarea name="content" id="content" rows="5" class="w-full border rounded p-3">{{ old('content') }}</textarea>
            @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Image --}}
        <div>
            <label for="image" class="block font-semibold mb-1">Image (optional)</label>
            <input type="file" name="image" id="image" class="w-full border rounded p-3">
            @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Submit --}}
        <div class="flex justify-between">
            <a href="{{ route('backend.admin.landings.index') }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Kembali</a>
            <button type="submit" class="px-6 py-2 rounded bg-emerald-500 text-white hover:bg-emerald-600">Simpan</button>
        </div>
    </form>
</div>
@endsection
