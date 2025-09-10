@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Operator - Stock Reports</h1>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
        {{ session('success') }}
    </div>
    @endif

    <!-- Generate Report Form -->
    <div class="mb-6 border p-4 rounded shadow-sm bg-white">
        <h2 class="font-semibold mb-2">Generate Stock Report</h2>
        <form action="{{ route('backend.operator.reports.generate') }}" method="POST" class="space-y-2">
            @csrf

            <div class="flex gap-2">
                <div class="flex-1">
                    <label class="block mb-1">Start Date</label>
                    <input type="date" name="periode_awal" class="w-full border p-2 rounded" required>
                    @error('periode_awal') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex-1">
                    <label class="block mb-1">End Date</label>
                    <input type="date" name="periode_akhir" class="w-full border p-2 rounded" required>
                    @error('periode_akhir') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block mb-1">Amount</label>
                <input type="number" name="amount" class="w-full border p-2 rounded" placeholder="Amount" required>
                @error('amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Generate
                Report</button>
        </form>
    </div>

    <!-- Reports Table -->
    <div class="overflow-x-auto bg-white rounded shadow-sm">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">ID</th>
                    <th class="border px-3 py-2">Type</th>
                    <th class="border px-3 py-2">Periode</th>
                    <th class="border px-3 py-2">Amount</th>
                    <th class="border px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                <tr class="text-center">
                    <td class="border px-3 py-2">{{ $report->id }}</td>
                    <td class="border px-3 py-2">{{ ucfirst($report->type) }}</td>
                    <td class="border px-3 py-2">{{ $report->periode_awal }} - {{ $report->periode_akhir }}</td>
                    <td class="border px-3 py-2">{{ $report->amount }}</td>
                    <td class="border px-3 py-2">
                        <a href="{{ route('backend.operator.reports.download', $report->id) }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded block md:inline-block w-full md:w-auto">Download</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border px-3 py-2 text-center">No reports found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $reports->links() }}
    </div>
</div>
@endsection