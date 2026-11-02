<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request and attach enterprise-grade HTTP security headers.
     * Protects against clickjacking, MIME sniffing, legacy XSS, and unauthorized sensor access.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Prevent clickjacking by restricting framing to same-origin
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Cross-site scripting filter protection for legacy clients
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Strict referrer policy: send referrer only on same-origin or HTTPS to HTTPS
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Restrict sensitive browser features and hardware access
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');

        return $response;
    }
}

