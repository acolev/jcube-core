<?php

namespace jCube\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Image;
use jCube\Http\Controllers\Controller;
use jCube\Models\Config;
use jCube\Models\ConfigCategory;
use jCube\Rules\FileTypeValidate;

class ConfigController extends Controller
{

	public function index(ConfigCategory $category)
	{
		$pageTitle = 'Configuration: ' . $category->getAttribute('title');

		$categories = ConfigCategory::get();
		$viewFile = 'admin::config.' . $category->slug;
		$viewFileAlt = 'admin.config.' . $category->slug;
		$configs = Config::where('category', $category->slug)->get();

		if (!view()->exists($viewFile)) {
			if (view()->exists($viewFileAlt)) {
				$viewFile = $viewFileAlt;
			} else {
				$viewFile = 'admin::config.default';
			}
		}

		return view($viewFile, compact(
			'pageTitle',
			'categories',
			'category',
			'configs'
		));
	}

	public function update(ConfigCategory $category, Request $request)
	{
		try {
			foreach ($request->getPayload() as $k => $v) {
				if ($k !== '_token') {
					$config = Config::where('category', $category->slug)
						->where('slug', $k)->first();
					if ($config->type === 'boolean' && $v === 'on') {
						$v = true;
					} elseif ($config->type === 'boolean') {
						$v = false;
					}
					if ($config->slug && $config->value !== $v) {
						$config->value = $v;
						$config->save();
					}
				}
			}
			Artisan::call('optimize:clear');
			$notify[] = ['success', 'Settings updated successfully'];
			return back()->withNotify($notify);
		} catch (\Exception $exception) {
			dd($request->getPayload() ,$exception);
		}
	}
}
