<?php

namespace jCube\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
	public function handle($request, Closure $next, $guard = 'admin')
	{
		if (Auth::guard($guard)->check()) {
			return to_route('admin.dashboard');
		}

		return $next($request);
	}
}
