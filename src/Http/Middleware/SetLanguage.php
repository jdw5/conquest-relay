<?php

namespace Conquest\Text\Http\Middleware;

use Closure;
use Conquest\Text\Facades\Text;
use Illuminate\Http\Request;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale(Text::getLanguage());
        return $next($request);
    }
}