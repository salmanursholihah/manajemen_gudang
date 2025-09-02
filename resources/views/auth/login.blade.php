@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-emerald-400">
    <div class="w-full max-w-md bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold text-gray-700 text-center">Login</h2>
        <p class="text-gray-500 text-center mb-6">Login ke aplikasi manajemen gudang</p>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-600">Email</label>
                <input type="email" name="email" placeholder="Email" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-600">Password</label>
                <input type="password" name="password" placeholder="Password" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <button type="submit"
                class="w-full bg-emerald-500 hover:bg-emerald-700 text-white py-2 rounded-lg font-semibold transition shadow-md">
                Login
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-600">
            belum punya akun?
            <a href="{{ route('register') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Register</a>
        </p>
    </div>
</div>
@endsection
