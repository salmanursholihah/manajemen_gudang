@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Viewer Dashboard</h1>
        <span class="text-gray-500">Welcome, {{ Auth::user()->name ?? 'Viewer' }} 👀</span>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Stock Items -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-indigo-100 text-indigo-600 rounded-xl">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Total Stock Items</h2>
                <p class="text-2xl font-bold">12,340</p>
            </div>
        </div>

        <!-- Transactions -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Transactions</h2>
                <p class="text-2xl font-bold">8,920</p>
            </div>
        </div>

        <!-- Reports Access -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-xl">
                <i class="fa-solid fa-chart-simple"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Reports Available</h2>
                <p class="text-2xl font-bold">24</p>
            </div>
        </div>
    </div>

    <!-- Stock Overview (Table) -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-xl font-semibold mb-4">Stock Overview</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-slate-100 text-left">
                    <th class="p-3">Item</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">In Stock</th>
                    <th class="p-3">Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="p-3">Product A</td>
                    <td class="p-3">Electronics</td>
                    <td class="p-3">1,200</td>
                    <td class="p-3">2025-08-28</td>
                </tr>
                <tr class="border-b">
                    <td class="p-3">Product B</td>
                    <td class="p-3">Raw Materials</td>
                    <td class="p-3">3,480</td>
                    <td class="p-3">2025-08-27</td>
                </tr>
                <tr>
                    <td class="p-3">Product C</td>
                    <td class="p-3">Spare Parts</td>
                    <td class="p-3">980</td>
                    <td class="p-3">2025-08-25</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Transactions Summary -->
    <!-- <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-xl font-semibold mb-4">Recent Transactions</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-slate-100 text-left">
                    <th class="p-3">Transaction ID</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="p-3">#TX-3041</td>
                    <td class="p-3">Outbound</td>
                    <td class="p-3 text-green-600 font-semibold">Completed</td>
                    <td class="p-3">Rp 1.200.000</td>
                </tr>
                <tr class="border-b">
                    <td class="p-3">#TX-3042</td>
                    <td class="p-3">Inbound</td>
                    <td class="p-3 text-yellow-600 font-semibold">Pending</td>
                    <td class="p-3">Rp 850.000</td>
                </tr>
                <tr>
                    <td class="p-3">#TX-3043</td>
                    <td class="p-3">Outbound</td>
                    <td class="p-3 text-red-600 font-semibold">Cancelled</td>
                    <td class="p-3">Rp 670.000</td>
                </tr>
            </tbody>
        </table>
    </div> -->
</div>
@endsection
