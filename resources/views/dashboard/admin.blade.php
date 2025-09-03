@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Admin Dashboard</h1>
        <span class="text-gray-500">
            Welcome back, {{ Auth::user()->name ?? 'Admin' }} 
            <i class="fa-solid fa-hand-wave text-yellow-500"></i>
        </span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Users -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Users</h2>
                <p class="text-2xl font-bold">152</p>
            </div>
        </div>

        <!-- Reports -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Reports</h2>
                <p class="text-2xl font-bold">12</p>
            </div>
        </div>

        <!-- Master Data -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-xl">
                <i class="fa-solid fa-gear"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Master Data</h2>
                <p class="text-2xl font-bold">8</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Recent Activity</h3>
            <ul class="text-gray-600 space-y-2 text-sm">
                <li><i class="fa-solid fa-circle-check text-green-500"></i> New user registered</li>
                <li><i class="fa-solid fa-file-arrow-down text-blue-500"></i> Monthly report uploaded</li>
                <li><i class="fa-solid fa-bolt text-yellow-500"></i> System updated</li>
            </ul>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Quick Actions</h3>
            <div class="space-x-3">
                <a href="{{ route('backend.admin.users.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Manage Users</a>
                <a href="{{ route('backend.admin.reports.index') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">View Reports</a>
            </div>
        </div>
    </div>
</div>
@endsection
