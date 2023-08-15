<?php

namespace jCube\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use jCube\Console\Commands\AdminCommand;
use jCube\Console\Commands\InstallCommand;
use jCube\Models\Admin;
use jCube\Http\Middleware\Permission;
use jCube\Http\Middleware\RedirectIfAdmin;
use jCube\Http\Middleware\RedirectIfNotAdmin;

class jCubeServiceProvider extends ServiceProvider
{

	public function boot(): void
	{
		$this->config();
		$this->middleware();

		view()->share([
			'layoutComponent'=> View::exists('components.layout')? 'layout' : 'admin::layout'
		]);

		$this->loadMigrationsFrom(dirname(dirname(__DIR__)) . '/database/migrations');
		$this->loadViewsFrom(dirname(__DIR__) . '/Views/admin', 'admin');

		$this->publishes([
			dirname(__DIR__) . '/Config/admin.php' => config_path('admin.php'),
		], 'core-config');

		Blade::anonymousComponentPath(dirname(__DIR__) . '/Views/components', 'admin');

		if ($this->app->runningInConsole()) {
			$this->commands([
				InstallCommand::class,
				AdminCommand::class,
			]);
		}
	}

	protected function middleware()
	{
		app('router')->aliasMiddleware('permission', Permission::class);
		app('router')->aliasMiddleware('admin', RedirectIfNotAdmin::class);
		app('router')->aliasMiddleware('admin.guest', RedirectIfAdmin::class);
	}

	protected function config()
	{

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

}