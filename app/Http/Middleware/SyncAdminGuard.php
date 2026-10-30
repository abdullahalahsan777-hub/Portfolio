<?php

namespace App\Http\Middleware;

use App\Models\User;
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
            /** @var User|null $user */
            $user = Auth::guard('web')->user();
            if ($user instanceof User && $user->isAdmin()) {
                Auth::guard('admin')->setUser($user);
            }
        } elseif (Auth::guard('admin')->check()) {
            /** @var User|null $user */
            $user = Auth::guard('admin')->user();
            if ($user instanceof User && $user->isAdmin()) {
                Auth::guard('web')->setUser($user);
            }
        }

        return $next($request);
    }
}


