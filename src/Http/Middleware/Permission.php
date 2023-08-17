<?php

namespace jCube\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{
    public function handle(Request $request, Closure $next, $permission = '')
    {
        $user = Auth::guard('admin')->user();
        if ($user->status || $user->access($permission)) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
