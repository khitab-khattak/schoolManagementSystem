<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AuthCommonMiddleware;
use App\Http\Middleware\ParentMiddleware;
use App\Http\Middleware\SchoolMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\TeacherMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'common'=>AuthCommonMiddleware::class,
            'school'=>SchoolMiddleware::class,
            'admin'=>AdminMiddleware::class,
            'parent'=>ParentMiddleware::class,
            'teacher'=>TeacherMiddleware::class,
            'student'=>StudentMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
