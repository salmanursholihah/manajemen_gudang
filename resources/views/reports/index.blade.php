@extends('layouts.app')

@section('title', 'Generate Report')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Generate Report</h1>

    <form action="{{ route('report.export') }}" method="POST" class="space-y-4">
        @csrf
        <label for="type" class="block font-semibold">Pilih Jenis Report</label>
        <select name="type" id="type" class="w-full border p-2 rounded">
            @foreach ($reportTypes as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Generate PDF
        </button>
    </form>
</div>
@endsection
