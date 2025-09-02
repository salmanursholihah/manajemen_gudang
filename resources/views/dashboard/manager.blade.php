@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Manager Dashboard</h1>
        <span class="text-gray-500">Hello, {{ Auth::user()->name ?? 'Manager' }} 📊</span>
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
                <p class="text-2xl font-bold">24</p>
            </div>
        </div>

        <!-- Stock Levels -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl">
               <i class="fa-solid fa-box-archive"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Stock Levels</h2>
                <p class="text-2xl font-bold">1,280</p>
            </div>
        </div>

        <!-- Performance -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-orange-100 text-orange-600 rounded-xl">
                <i class="fa-solid fa-rocket"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Performance</h2>
                <p class="text-2xl font-bold">92%</p>
            </div>
        </div>
    </div>

    <!-- Detailed Sections -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Latest Reports -->
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Latest Reports</h3>
            <ul class="text-gray-600 space-y-2 text-sm">
                <li><i class="fa-solid fa-calendar-days"></i> Sales Report - August 2025</li>
                <li>
                    <i class="fa-solid fa-chart-column"></i> Inventory Status - Week 34
                </li>
                <li><i class="fa-solid fa-chart-line"></i> Performance Summary - Q3</li>
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Quick Actions</h3>
            <div class="space-x-3">
                <a href="{{ route('manager.reports.index') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">View Reports</a>
                <a href="{{ url('/transactions') }}"
                    class="px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-700">Check Stock</a>
            </div>
        </div>
    </div>
</div>
@endsection