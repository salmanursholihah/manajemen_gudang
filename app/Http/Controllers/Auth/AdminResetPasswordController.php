<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminResetPasswordController extends Controller
{
 public function generate($email)
    {
        // Hapus token lama untuk email ini
        DB::table('password_resets')->where('email', $email)->delete();

        // Buat token baru
        $token = Str::random(60);

        // Simpan token ke DB
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => Hash::make($token), // sesuai default Laravel
            'created_at' => now(),
        ]);

        // Buat link reset password
        $link = url(route('password.reset', [
            'token' => $token,
            'email' => $email,
        ], false));

        // Kirim balik ke view
        return back()->with('reset_link', $link);
    }
}

