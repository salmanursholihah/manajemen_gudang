@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Operator</h1>
        <span class="text-gray-500">Hello, {{ Auth::user()->name ?? 'Operator' }} 👷</span>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Inbound -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                📥
            </div>
            <div>
                <h2 class="text-lg font-semibold">Inbound Today</h2>
                <p class="text-2xl font-bold">128</p>
            </div>
        </div>

        <!-- Outbound -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-red-100 text-red-600 rounded-xl">
                📤
            </div>
            <div>
                <h2 class="text-lg font-semibold">Outbound Today</h2>
                <p class="text-2xl font-bold">96</p>
            </div>
        </div>

        <!-- Current Stock -->
        <div class="bg-white rounded-2xl shadow p-6 flex items-center space-x-4 hover:shadow-lg transition">
            <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                <i class="fa-solid fa-box-archive"></i>

            </div>
            <div>
                <h2 class="text-lg font-semibold">Current Stock</h2>
                <p class="text-2xl font-bold">12,450</p>
            </div>
        </div>
    </div>

    <!-- Operator Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- QR Scan -->
        <div
            class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition flex flex-col items-center justify-center">
            <div class="text-5xl mb-4">📷</div>
            <h3 class="text-xl font-semibold mb-2">Scan QR</h3>
            <p class="text-gray-600 mb-4">Quickly scan items for inbound & outbound.</p>
            <a href="{{ url('/scan') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Start Scanning</a>
        </div>

        <!-- Inbound & Outbound Actions -->
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Stock Operations</h3>
            <div class="space-y-3">
                <a href="{{ url('/inbound') }}"
                    class="block px-4 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">➕ Add Inbound
                    Stock</a>
                <a href="{{ url('/outbound') }}"
                    class="block px-4 py-3 bg-red-600 text-white rounded-lg shadow hover:bg-red-700">➖ Process Outbound
                    Stock</a>
            </div>
        </div>
    </div>
</div>
@endsection