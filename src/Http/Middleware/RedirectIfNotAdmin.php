<?php

namespace jCube\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
	public function handle($request, Closure $next, $guard = 'admin')
	{
		if (!Auth::guard($guard)->check()) {
			return to_route('admin.login');
		} else {
			app()->setLocale(Auth::guard($guard)->user()->lang ?: config('app.locale'));
		}

		return $next($request);
	}
}
