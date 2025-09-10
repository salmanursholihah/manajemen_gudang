@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Admin Dashboard</h1>
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
        <!-- Users -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Users</h2>
                <p class="text-2xl font-bold">{{ $userCount }}</p>
            </div>
        </div>

        <!-- Reports -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Reports</h2>
                <p class="text-2xl font-bold">{{ $reportCount }}</p>
            </div>
        </div>

        <!-- Products -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-xl">
                <i class="fa-solid fa-box"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Products</h2>
                <p class="text-2xl font-bold">{{ $productCount }}</p>
            </div>
        </div>
    </div>

    <!-- Grafik Produk + Tabel User -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Chart -->
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Produk per Kategori</h3>
            <canvas id="productChart"></canvas>
        </div>

        <!-- User Table -->
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">User Terbaru</h3>
            <table class="w-full text-sm text-left border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentUsers as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border">{{ $user->role }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
                <a href="{{ route('backend.admin.users.index') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Manage Users</a>
                <a href="{{ route('backend.admin.reports.index') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">View Reports</a>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('productChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($categories),
                datasets: [{
                    label: 'Jumlah Produk',
                    data: @json($productData),
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    </script>
    @endpush