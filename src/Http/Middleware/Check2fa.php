<?php

namespace jCube\Http\Middleware;

use Closure;

class Check2fa
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'user')
	{
		$authCheck = $guard != 'user' ? auth()->guard($guard)->check() : auth()->check();

		if ($authCheck) {
			$user = $guard != 'user' ? auth()->guard($guard)->user() : auth()->user();
			if ($user->tv) {
				return $next($request);
			} else {
				return to_route("$guard.authorization");
			}
		}
		abort(403);
	}
}
