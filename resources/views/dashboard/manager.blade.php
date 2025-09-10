@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Manager Dashboard</h1>
        <div class="flex items-center space-x-3">
            <span class="text-gray-500">
                Welcome back, {{ Auth::user()->name ?? 'Admin' }}
            </span>
            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('default-avatar.png') }}"
                alt="Profile Picture" class="w-20 h-20 rounded-full">
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Reports -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-indigo-100 text-indigo-600 rounded-xl">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Reports</h2>
                <p class="text-2xl font-bold">{{ $reportCount }}</p>
            </div>
        </div>

        <!-- Stock Levels -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Stock Levels</h2>
                <p class="text-2xl font-bold">{{ $stockLevels }}</p>
            </div>
        </div>

        <!-- Performance -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-orange-100 text-orange-600 rounded-xl">
                <i class="fa-solid fa-rocket"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Performance</h2>
                <p class="text-2xl font-bold">{{ $performance }}%</p>
            </div>
        </div>
    </div>

    <!-- Latest Reports + Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Latest Reports -->
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Latest Reports</h3>
            <ul class="text-gray-600 space-y-2 text-sm">
                @foreach($latestReports as $report)
                <li>
                    <i class="fa-solid fa-file-alt text-indigo-500"></i>
                    {{ $report->title }} - {{ $report->created_at->format('d M Y') }}
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Quick Actions</h3>
            <div class="space-x-3">
                <a href="{{ route('backend.manager.reports.index') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">View Reports</a>
                <a href="{{ route('backend.manager.products.index') }}"
                    class="px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-700">Check Stock</a>
            </div>
        </div>
    </div>
</div>
@endsection