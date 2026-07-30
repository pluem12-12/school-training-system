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
    ->withMiddleware(function (Middleware $middleware) {
        // Trust all proxies for Render/Heroku (so HTTPS works correctly)
        $middleware->trustProxies(at: '*');

        // ลงทะเบียน Middleware ของคุณที่นี่ด้วย alias
        $middleware->alias([
            'role' => \App\Http\Middleware\EnsureUserRoleIs::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();