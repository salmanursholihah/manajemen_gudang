<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
      public function index()
    {
        $user = Auth::user();

        // arahkan ke dashboard sesuai role
        switch ($user->role) {
            case 'admin':
                return view('dashboard.admin', compact('user'));
            case 'manager':
                return view('dashboard.manager', compact('user'));
            case 'sales':
                return view('dashboard.sales', compact('user'));
            case 'operator':
                return view('dashboard.operator', compact('user'));
            default:
                return view('dashboard.viewer', compact('user'));
        }
    }
}
