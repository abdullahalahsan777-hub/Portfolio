<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckMaintenanceMode;
use App\Http\Middleware\SyncAdminGuard;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'superadmin' => AdminMiddleware::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'log/browser-error',
        ]);
        $middleware->web(append: [
            CheckMaintenanceMode::class,
            SyncAdminGuard::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->report(function (\Throwable $e) {
            try {
                $request = request();
                $route = $request ? $request->route() : null;
                $actionName = $route ? $route->getActionName() : 'Closure/Direct';
                $url = $request ? $request->fullUrl() : 'CLI';
                $method = $request ? $request->method() : 'CLI';
                $ip = $request ? $request->ip() : 'N/A';
                $userId = Auth::id() ?? 'Guest';

                Log::error(
                    sprintf(
                        "[Application Error] %s: %s in %s:%d | Route: %s | Action: %s | Method: %s | URL: %s | User: %s | IP: %s",
                        get_class($e),
                        $e->getMessage(),
                        $e->getFile(),
                        $e->getLine(),
                        $route ? ($route->getName() ?? 'unnamed') : 'N/A',
                        $actionName,
                        $method,
                        $url,
                        $userId,
                        $ip
                    ),
                    [
                        'exception_class' => get_class($e),
                        'message'         => $e->getMessage(),
                        'file'            => $e->getFile(),
                        'line'            => $e->getLine(),
                        'action'          => $actionName,
                        'url'             => $url,
                        'method'          => $method,
                        'user_id'         => $userId,
                        'ip'              => $ip,
                    ]
                );
            } catch (\Throwable $loggingFallback) {
                // Fail-safe fallback to prevent exception recursion
            }
        });
    })->create();
