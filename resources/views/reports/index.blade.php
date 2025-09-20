@extends('layouts.app')

@section('title', 'Pilih Report')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Generate Report</h1>

    @if (count($reportTypes) > 0)
        <form action="{{ route('report.export') }}" method="POST">
            @csrf
        <div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <h1 class="text-xl font-bold mb-4">Pilih Report</h1>

    <form method="POST" action="{{ route('report.export') }}" target="_blank">
        @csrf
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">
                Jenis Report
            </label>
            <select id="type" name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @foreach($reportTypes as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Generate & Download PDF
        </button>
    </form>
</div>
        </form>
    @else
        <p class="text-red-600">Anda tidak memiliki akses untuk generate report.</p>
    @endif
</div>
@endsection
