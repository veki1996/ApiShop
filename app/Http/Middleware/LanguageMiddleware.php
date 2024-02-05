<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (env('LANG_CODE') && env('LANG_CODE') != app() -> getLocale()) {
            app() -> setLocale(env('LANG_CODE'));
        }

        return $next($request);
    }
}
