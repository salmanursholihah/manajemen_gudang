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
            <h2 class="text-3xl font-bold text-gray-700 mb-2">Forgot password</h2>
            <p class="text-gray-500 mb-6">Login ke aplikasi manajemen gudang</p>
 @if (session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded mb-4" required>

        <button   class="w-full bg-emerald-500 hover:bg-emerald-700 text-white py-2 rounded-lg font-semibold transition shadow-md">Kirim Link Reset</button>
    </form>
        </div>

        <!-- kanan : ilustrasi -->
        <div class="flex-1 flex items-center justify-center p-8 relative z-20">
            <img src="{{ $loginIllustration = setting('login_illustration') ? asset('storage/' . setting('login_illustration')) : 'https://cdn-icons-png.flaticon.com/512/2920/2920321.png' }}"
                alt="Login Illustration" class="max-w-[80%] drop-shadow-lg">
        </div>
    </div>
</div>
@endsection