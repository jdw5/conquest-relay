<?php

namespace Conquest\Relay\Http\Middleware;

use Closure;
use Conquest\Relay\Facades\Relay;
use Illuminate\Http\Request;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale(Relay::getLanguage());
        return $next($request);
    }
}