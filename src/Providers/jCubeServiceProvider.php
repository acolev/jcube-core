<?php

namespace jCube\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use jCube\Components\ColumnItem;
use jCube\Components\ColumnsOrTabs;
use jCube\Components\DataTable;
use jCube\Components\TabItem;
use jCube\Components\Table;
use jCube\Components\TableItem;
use jCube\Components\Tabs;
use jCube\Console\Commands\AdminCommand;
use jCube\Console\Commands\InstallCommand;
use jCube\Console\Commands\LayoutCommand;
use jCube\Console\Commands\ModelCommand;
use jCube\Console\Commands\NotifyCommand;
use jCube\Console\Commands\UpdateCommand;
use jCube\Http\Middleware\ActiveAdmin;
use jCube\Http\Middleware\Check2fa;
use jCube\Http\Middleware\Permission;
use jCube\Http\Middleware\RedirectIfAdmin;
use jCube\Http\Middleware\RedirectIfNotAdmin;
use jCube\Models\Admin;

class jCubeServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    $this->registerConfig();
    $this->registerMiddleware();
    $this->registerCommands();
    $this->registerComponents();
    $this->registerLoads();
    $this->registerPublishes();

    view()->share([
      'layoutComponent' => View::exists('components.admin.layout') ? 'admin.layout' : 'admin::layout',
      'global_components_path' => dirname(__DIR__) . '/Views/components/global/',
    ]);

    Paginator::useBootstrap();
  }

  protected function registerMiddleware()
  {
    app('router')->aliasMiddleware('permission', Permission::class);
    app('router')->aliasMiddleware('admin', RedirectIfNotAdmin::class);
    app('router')->aliasMiddleware('admin.guest', RedirectIfAdmin::class);
    app('router')->aliasMiddleware('2fa', Check2fa::class);
    app('router')->aliasMiddleware('active.admin', ActiveAdmin::class);
  }

  protected function registerConfig()
  {
    Config::set('app.providers', [
      ...config('app.providers'),
      \Spatie\Permission\PermissionServiceProvider::class,
    ]);

    Config::set('auth.guards.admin', [
      'driver' => 'session',
      'provider' => 'admins',
    ]);
    Config::set('auth.providers.admins', [
      'driver' => 'eloquent',
      'model' => Admin::class,
    ]);
    Config::set('auth.passwords.admin', [
      'provider' => 'admins',
      'table' => 'password_reset_tokens',
      'expire' => 60,
      'throttle' => 60,
    ]);
    Config::set('filesystems.links.' . public_path('admin_assets'), dirname(__DIR__, 2) . '/assets');

  }

  protected function registerCommands()
  {
    if ($this->app->runningInConsole()) {
      $this->commands([
        InstallCommand::class,
        AdminCommand::class,
        NotifyCommand::class,
        LayoutCommand::class,
        UpdateCommand::class,
        ModelCommand::class,
      ]);
    }
  }

  protected function registerComponents()
  {
    Blade::anonymousComponentPath(dirname(__DIR__) . '/Views/components/admin', 'admin');
  }

  protected function registerLoads()
  {
    $this->loadMigrationsFrom(dirname(dirname(__DIR__)) . '/database/migrations');
    $this->loadViewsFrom(dirname(__DIR__) . '/Views/admin', 'admin');
  }

  protected function registerPublishes()
  {
    $this->publishes([
      dirname(__DIR__) . '/Config/admin.php' => config_path('admin.php'),
    ], 'core-config');
    $this->publishes([
      dirname(__DIR__) . '/Config/adminMenu.php' => config_path('adminMenu.php'),
    ], 'core-config');
  }
}
