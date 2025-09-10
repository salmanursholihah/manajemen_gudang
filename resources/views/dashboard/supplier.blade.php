@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Supplier Dashboard</h1>
        <div class="flex items-center space-x-3">
            <span class="text-gray-500">
                Welcome back, {{ Auth::user()->name ?? 'Admin' }}
            </span>
            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('default-avatar.png') }}"
                alt="Profile Picture" class="w-20 h-20 rounded-full">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Sales -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Total Sales</h2>
                <p class="text-2xl font-bold">Rp {{ number_format($totalSales,0,'.','.') }}</p>
            </div>
        </div>

        <!-- Customers -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Customers</h2>
                <p class="text-2xl font-bold">{{ $customerCount }}</p>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-xl">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Pending Orders</h2>
                <p class="text-2xl font-bold">{{ $pendingOrders }}</p>
            </div>
        </div>
    </div>


    <!-- Sales Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Manage Transactions -->
        <div
            class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition flex flex-col items-center justify-center">
            <div class="text-5xl mb-4">🧾</div>
            <h3 class="text-xl font-semibold mb-2">Transactions</h3>
            <p class="text-gray-600 mb-4">Manage and review sales transactions.</p>
            <a href="{{ url('/transactions') }}"
                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">Go to Transactions</a>
        </div>

        <!-- Manage Customers -->
        <div
            class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition flex flex-col items-center justify-center">
            <div class="text-5xl mb-4">👤</div>
            <h3 class="text-xl font-semibold mb-2">Customers</h3>
            <p class="text-gray-600 mb-4">Track and manage customer data.</p>
            <a href="{{ url('/customers') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Go to Customers</a>
        </div>
    </div>

    <!-- Recent Orders -->
    <!-- <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-xl font-semibold mb-4">Recent Orders</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-slate-100 text-left">
                    <th class="p-3">Order ID</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="p-3">#ORD-1023</td>
                    <td class="p-3">PT Maju Jaya</td>
                    <td class="p-3 text-green-600 font-semibold">Completed</td>
                    <td class="p-3">Rp 12.500.000</td>
                </tr>
                <tr class="border-b">
                    <td class="p-3">#ORD-1024</td>
                    <td class="p-3">CV Sejahtera</td>
                    <td class="p-3 text-yellow-600 font-semibold">Pending</td>
                    <td class="p-3">Rp 4.300.000</td>
                </tr>
                <tr>
                    <td class="p-3">#ORD-1025</td>
                    <td class="p-3">PT Sumber Makmur</td>
                    <td class="p-3 text-red-600 font-semibold">Cancelled</td>
                    <td class="p-3">Rp 7.800.000</td>
                </tr>
            </tbody>
        </table>
    </div> -->
</div>
@endsection