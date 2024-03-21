<?php

namespace jCube\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $segment = $request->segment(1);
        $locale = '';
        if (strlen($segment) === 2) {
            $locale = ltrim($segment, '/');
        }
        $default_locale = config('translatable.locale');
        app()->setLocale($locale ?: $default_locale);
        return $next($request);

    }

}
