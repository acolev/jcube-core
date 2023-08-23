<?php

namespace jCube\Http\Middleware;

use jCube\Constants\Status;
use App\Models\Language;
use Closure;

class LanguageMiddleware
{

	public function handle($request, Closure $next, $guard = '')
	{
		$key = implode('-', [$guard, 'lang']);
		session()->put($key, $this->getCode($key));
		app()->setLocale(session($key, $this->getCode($key)));
		return $next($request);
	}

	public function getCode($key)
	{
		if (class_exists(Language::class)) {
			if (session()->has($key)) {
				return session($key);
			}
			$language = Language::where('is_default', Status::ENABLE)->first();
		}
		return isset($language) ? $language->code : config('app.locale');
	}


}
