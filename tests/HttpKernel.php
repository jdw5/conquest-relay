<?php

namespace Conquest\Relay\Tests;

use Conquest\Relay\Http\Middleware\RelaysTranslations;
use Illuminate\Foundation\Http\Kernel;

class HttpKernel extends Kernel
{
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        \Inertia\Middleware::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            RelaysTranslations::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

        ],
    ];
}
