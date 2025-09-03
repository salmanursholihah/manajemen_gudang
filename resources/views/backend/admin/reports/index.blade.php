@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h2 class="text-xl font-bold mb-4">Reports</h2>

    <!-- Form Filter -->
    <form method="GET" action="{{ route('backend.admin.reports.index') }}" class="flex space-x-2 mb-4">
        <input type="date" name="start_date" class="border rounded px-2 py-1" 
               value="{{ request('start_date') }}">
        <input type="date" name="end_date" class="border rounded px-2 py-1"
               value="{{ request('end_date') }}">

        <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">
            Generate
        </button>

        <a href="{{ route('backend.admin.reports.index', ['all' => true]) }}" 
           class="px-3 py-1 bg-gray-500 text-white rounded">
            All Reports
        </a>
    </form>

    <!-- Table Reports -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border text-left">Date</th>
                    <th class="p-2 border text-left">Type</th>
                    <th class="p-2 border text-left">Amount</th>
                    <th class="p-2 border text-left">User</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                    <tr>
                        <td class="p-2 border">{{ $report->created_at->format('Y-m-d') }}</td>
                        <td class="p-2 border">{{ $report->type }}</td>
                        <td class="p-2 border">{{ number_format($report->amount, 0, ',', '.') }}</td>
                        <td class="p-2 border">{{ $report->generate_by }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-2 border text-center text-gray-500">No reports found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
</div>
@endsection
