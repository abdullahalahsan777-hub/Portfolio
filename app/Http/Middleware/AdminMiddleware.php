<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            flash()->warning('Please log in to access the admin area.');

            return redirect()->route('login');
        }

        /** @var User|null $user */
        $user = Auth::user();

        if (! $user instanceof User || ! $user->isAdmin()) {
            abort(403, 'Unauthorized access: Administrator privileges required.');
        }

        return $next($request);
    }
}
