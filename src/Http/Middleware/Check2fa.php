<?php

namespace jCube\Http\Middleware;

use Closure;

class Check2fa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authCheck = auth()->guard('admin')->check();

        if ($authCheck) {
            $user = auth()->guard('admin')->user();
            if ($user->tv) {
                return $next($request);
            } else {
                return to_route("admin.authorization");
            }
        }
        abort(403);
    }
}
