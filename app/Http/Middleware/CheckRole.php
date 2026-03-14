<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Cek role secara langsung tanpa method isAdmin()
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }

            // Handle khusus untuk admin (termasuk super_admin)
            if ($role === 'admin' && ($user->role === 'admin' || $user->role === 'super_admin')) {
                return $next($request);
            }
        }

        // Jika tidak punya akses
        abort(403, 'Unauthorized access.');
    }
}
