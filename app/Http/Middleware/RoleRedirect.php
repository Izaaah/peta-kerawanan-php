<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Cek jika sudah di dashboard yang sesuai, jangan redirect lagi
            if (
                ($user->role === 'super-admin' && $request->routeIs('super-admin.dashboard')) ||
                ($user->role === 'administrator' && $request->routeIs('admin.dashboard')) ||
                ($user->role === 'operator' && $request->routeIs('operator.dashboard'))
            ) {
                return $next($request);
            }

            // Redirect based on role
            if ($user->role === 'super-admin') {
                return redirect()->route('super-admin.dashboard');
            } elseif ($user->role === 'administrator') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'operator') {
                return redirect()->route('operator.dashboard');
            }
        }

        return $next($request);
    }
}
