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
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::guard($role)->check()) {
            if (Auth::guard('web')->check() || Auth::guard('admin')->check() || Auth::guard('teacher')->check()) {
                abort(403, 'Unauthorized action.');
            }
            return redirect()->route('login', ['role' => $role]);
        }

        return $next($request);
    }
}
