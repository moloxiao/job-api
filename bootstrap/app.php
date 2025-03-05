<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // Add this import
use Throwable; // Add this import
use Illuminate\Support\Facades\Log; // Add this import

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                Log::error('API Error: ' . $e->getMessage());
                
                return response()->json([
                    'error' => $e->getMessage(),
                    // 可选：如果需要更多调试信息
                    // 'code' => $e->getCode(),
                    // 'file' => $e->getFile(),
                    // 'line' => $e->getLine(),
                ], 500);
            }
            
            return null; // 让其他异常处理程序处理非 API 异常
        });
    })->create();