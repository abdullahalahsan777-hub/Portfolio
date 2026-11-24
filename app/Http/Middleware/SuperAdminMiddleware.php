<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            flash()->warning('Please log in to access this area.');

            return redirect()->route('login');
        }

        /** @var User|null $user */
        $user = Auth::user();

        if (! $user instanceof User || ! $user->isSuperAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden: Super Administrator privileges required.'], 403);
            }

            abort(403, 'Unauthorized access: Super Administrator privileges required.');
        }

        return $next($request);
    }
}
