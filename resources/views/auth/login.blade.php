@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white relative overflow-hidden">

    <!-- background lingkaran kanan -->
    <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-br from-emerald-200 to-emerald-400 
                rounded-l-[50%]"></div>

    <!-- card utama -->
    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-2xl flex overflow-hidden relative z-10">

        <!-- kiri : form -->
        <div class="flex-1 p-10">
            <h2 class="text-3xl font-bold text-gray-700 mb-2">Login</h2>
            <p class="text-gray-500 mb-6">Login ke aplikasi manajemen gudang</p>

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

            <p class="mt-6 text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}"
                    class="text-emerald-600 hover:text-emerald-800 font-medium">Register</a>
            </p>
        </div>

        <!-- kanan : ilustrasi -->
        <div class="flex-1 flex items-center justify-center p-8 relative z-20">
            <img src="{{ $loginIllustration = setting('login_illustration') ? asset('storage/' . setting('login_illustration')) : 'https://cdn-icons-png.flaticon.com/512/2920/2920321.png' }}"
                alt="Login Illustration" class="max-w-[80%] drop-shadow-lg">
        </div>
    </div>
</div>
@endsection