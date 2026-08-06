<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'student' => \App\Http\Middleware\StudentMiddleware::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'logout',
            'student/logout'
        ]);

        $middleware->redirectUsersTo(function (\Illuminate\Http\Request $request) {
            if (\Illuminate\Support\Facades\Auth::guard('admin')->check()) {
                return route('admin.dashboard');
            } elseif (\Illuminate\Support\Facades\Auth::guard('teacher')->check()) {
                return route('teacher.dashboard');
            }
            
            if (\Illuminate\Support\Facades\Auth::guard('web')->check()) {
                \Illuminate\Support\Facades\Auth::guard('web')->logout();
                return '/login';
            }

            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
