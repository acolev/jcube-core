<?php

namespace jCube\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use jCube\Http\Controllers\Controller;
use jCube\Models\SystemPages;
use jCube\Rules\FileTypeValidate;
use Image;

class GeneralSettingController extends Controller
{
	public function index()
	{
		$pageTitle = 'General Setting';
		$timezones = timezoneList();

		return view('admin::setting.general', compact('pageTitle', 'timezones'));
	}

	public function update(Request $request)
	{
		$request->validate([
			'site_name' => 'required|string|max:40',
		]);

		$general = gs();
		$general->site_name = $request->site_name;
		$general->data_values = array_merge((array)$general->data_values, (array)$request->data_values);
		$general->save();

		$timezoneFile = config_path('timezone.php');
		$content = '<?php $timezone = ' . $request->timezone . ' ?>';
		file_put_contents($timezoneFile, $content);
		Artisan::call('optimize:clear');
		$notify[] = ['success', 'General setting updated successfully'];
		return back()->withNotify($notify);
	}

	public function systemConfiguration()
	{
		$pageTitle = 'System Configuration';
		return view('admin::setting.configuration', compact('pageTitle'));
	}

	public function systemConfigurationSubmit(Request $request)
	{
		$general = gs();
		$general->data_values =  array_merge((array)$general->data_values, (array)$request->data_values);
		$general->save();
		Artisan::call('optimize:clear');
		$notify[] = ['success', 'System configuration updated successfully'];
		return back()->withNotify($notify);
	}

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
		if (!file_exists($file)) {
			fopen($file, "w");
		}
		file_put_contents($file, $request->css);
		$notify[] = ['success', 'CSS updated successfully'];
		return back()->withNotify($notify);
	}

	public function maintenanceMode()
	{
		$pageTitle = 'Maintenance Mode';
		$maintenance = SystemPages::where('data_keys', 'maintenance')->first();
		return view('admin::setting.maintenance', compact('pageTitle', 'maintenance'));
	}

	public function maintenanceModeSubmit(Request $request)
	{
		$notify = [];
		$request->validate([
			'description' => 'required',
		]);
		$maintenance = SystemPages::where('data_keys', 'maintenance')->first();
		if ($maintenance == null) {
			$maintenance = new SystemPages();
			$maintenance->data_keys = 'maintenance';
		}
		$maintenance->short_description = $request->short_desc;
		$maintenance->description = $request->description;
		$maintenance->status = $request->status ? 1 : 0;

		$maintenance->save();
		$notify[] = ['success', 'Maintenance updated successfully'];
		return back()->withNotify($notify);
	}

	public function cookie()
	{
		$pageTitle = 'GDPR Cookie';
		$cookie = SystemPages::where('data_keys', 'cookie')->first();
		return view('admin::setting.cookie', compact('pageTitle', 'cookie'));
	}

	public function cookieSubmit(Request $request)
	{
		$notify = [];
		$request->validate([
			'short_desc' => 'required',
			'description' => 'required',
		]);
		$cookie = SystemPages::where('data_keys', 'cookie')->first();
		if ($cookie == null) {
			$cookie = new SystemPages();
			$cookie->data_keys = 'cookie';
		}
		$cookie->short_description = $request->short_desc;
		$cookie->description = $request->description;
		$cookie->status = $request->status ? 1 : 0;

		$cookie->save();
		$notify[] = ['success', 'Cookie policy updated successfully'];
		return back()->withNotify($notify);
	}

}
