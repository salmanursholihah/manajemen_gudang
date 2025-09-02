@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-emerald-600">
    <div class="w-full max-w-md bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold text-gray-700 text-center">Register</h2>
        <p class="text-gray-500 text-center mb-6">Buat akun baru Anda</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-600">Nama</label>
                <input type="text" name="name" placeholder="Nama" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

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

            <div>
                <label class="block text-gray-600">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <button type="submit"
                class="w-full bg-emerald-500 hover:bg-emerald-700 text-white py-2 rounded-lg font-semibold transition shadow-md">
                Register
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Login</a>
        </p>
    </div>
</div>
@endsection
