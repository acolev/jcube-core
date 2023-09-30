<?php

namespace jCube\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
  protected $namespace = 'jCube\Http\Controllers';
  
  public function boot(): void
  {
    Route::namespace($this->namespace)->group(function () {
      // admin routes
      Route::middleware('web')
        ->namespace('Admin')
        ->prefix(env('ADMIN_PREFIX') ?: 'admin')
        ->name('admin.')
        ->group(dirname(__DIR__) . '/Routes/admin.php');
      
      if (file_exists(base_path('routes/admin.php')))
        Route::middleware(['web', 'admin', '2fa:admin'])
          ->namespace('\App\Http\Controllers\Admin')
          ->prefix(env('ADMIN_PREFIX') ?: 'admin')
          ->name('admin.')
          ->group(base_path('routes/admin.php'));
      
      Route::middleware(['api'])
        ->prefix('api')
        ->group(dirname(__DIR__) . '/Routes/api.php');
      
      Route::middleware(['web'])
        ->group(dirname(__DIR__) . '/Routes/web.php');
    });
  }
}
