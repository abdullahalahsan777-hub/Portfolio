<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SyncAdminGuard
{
    /**
     * Synchronize administrator credentials between default 'web' and requested 'admin' guard.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if ($user && $user->isAdmin()) {
                Auth::guard('admin')->setUser($user);
            }
        } elseif (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            if ($user && $user->isAdmin()) {
                Auth::guard('web')->setUser($user);
            }
        }

        return $next($request);
    }
}
