<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    // Ambil role user lowercase
    $userRole = strtolower(Auth::user()->role ?? '');
    // Ambil semua role middleware lowercase
    $allowedRoles = array_map('strtolower', $roles);

    if (!in_array($userRole, $allowedRoles)) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}
}
