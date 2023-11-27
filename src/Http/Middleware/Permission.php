<?php

namespace jCube\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission extends \Spatie\Permission\Middleware\PermissionMiddleware
{
  
  
  public function handle($request, Closure $next, $permission, $guard = 'admin')
  {
    $user = Auth::guard($guard)->user();
    if ($user->status) return $next($request);
    return parent::handle($request, $next, $permission, $guard);
  }
}
