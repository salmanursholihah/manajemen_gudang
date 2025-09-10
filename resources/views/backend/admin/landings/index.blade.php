@extends('layouts.app')

@section('content')

 <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Konten Landing Page </h1>
        <a href="{{ route('backend.admin.landings.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Add landing</a>
    </div>
<table class="table-auto w-full border">
    <thead>
        <tr>
            <th class="py-4 px-2 border">Section</th>
            <th class="py-4 px-2 border">Judul</th>
            <th class="py-4 px-2 border">Konten</th>
            <th class="py-4 px-2 border">Gambar</th>
            <th class="py-4 px-2 border">Urutan</th>
            <th class="py-4 px-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contents as $c)
        <tr>
            <td>{{ $c->section }}</td>
            <td>{{ $c->title }}</td>
            <td>{{ Str::limit($c->content, 50) }}</td>
            <td>
                @if($c->image)
                <img src="{{ asset('storage/'.$c->image) }}" class="h-12">
                @endif
            </td>
            <td>{{ $c->order }}</td>
            <td>
                <a href="{{ route('backend.admin.landings.edit', $c) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('backend.admin.landings.destroy', $c) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Hapus konten?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
