<?php

namespace jCube\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Image;
use jCube\Http\Controllers\Controller;
use jCube\Rules\FileTypeValidate;

class GeneralSettingController extends Controller
{
	public function logoIcon()
	{
		$pageTitle = 'Logo & Favicon';

		return view('admin::setting.logo_icon', compact('pageTitle'));
	}

	public function logoIconUpdate(Request $request)
	{

		$request->validate([
			'logo' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
			'logo_dark' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
			'favicon' => ['image', new FileTypeValidate(['png'])],
		]);

		if ($request->hasFile('logo')) {
			try {
				$path = getFilePath('logoIcon');
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}
				Image::make($request->logo)->save($path . '/logo.png');
			} catch (\Exception $exp) {
				$notify[] = ['error', 'Couldn\'t upload the logo'];

				return back()->withNotify($notify);
			}
		}
		if ($request->hasFile('logo_dark')) {
			try {
				$path = getFilePath('logoIcon');
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}
				Image::make($request->logo_dark)->save($path . '/logo_dark.png');
			} catch (\Exception $exp) {
				$notify[] = ['error', 'Couldn\'t upload the logo'];

				Artisan::call('optimize:clear');
				return back()->withNotify($notify);
			}
		}

		if ($request->hasFile('favicon')) {
			try {
				$path = getFilePath('logoIcon');
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}
				$size = explode('x', getFileSize('favicon'));
				Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
			} catch (\Exception $exp) {
				$notify[] = ['error', 'Couldn\'t upload the favicon'];

				return back()->withNotify($notify);
			}
		}
		$notify[] = ['success', 'Logo & favicon updated successfully'];

		return back()->withNotify($notify);
	}

	public function customCss()
	{
		$pageTitle = 'Custom CSS';
		$file = activeTemplate(true) . 'css/custom.css';
		$fileContent = @file_get_contents($file);

		return view('admin::setting.custom_css', compact('pageTitle', 'fileContent'));
	}

	public function customCssSubmit(Request $request)
	{
		$file = activeTemplate(true) . 'css/custom.css';
		if (!is_dir(dirname($file))) {
			mkdir(dirname($file), 0755, true);
		}
		if (!file_exists($file)) {
			fopen($file, 'w');
		}
		file_put_contents($file, $request->css);
		$notify[] = ['success', 'CSS updated successfully'];

		return back()->withNotify($notify);
	}
}
