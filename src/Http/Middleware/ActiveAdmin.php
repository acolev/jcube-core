<?php

namespace jCube\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ActiveAdmin
{
	public function handle($request, Closure $next, $guard = 'admin')
	{
    if(Auth::guard($guard)->user()->status === 0){
      Auth::guard($guard)->logout();
      $request->session()->invalidate();
      $notify[] = ['error', 'Your account is blocked'];
      return to_route('admin.login')->with('notify', $notify);
    }

		return $next($request);
	}
}
