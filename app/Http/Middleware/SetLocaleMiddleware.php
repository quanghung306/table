<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Accept-Language', config('app.locale'));

        if (in_array($locale, ['en', 'vi'])) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
