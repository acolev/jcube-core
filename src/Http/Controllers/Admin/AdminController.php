<?php

namespace jCube\Http\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;
use jCube\Models\AdminNotification;
use Illuminate\Support\Facades\Hash;
use jCube\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jCube\Http\Controllers\Controller;

class AdminController extends Controller
{
	public function dashboard()
	{
		$pageTitle = 'Dashboard';

		return view('admin::dashboard', compact('pageTitle'));
	}

	public function profile()
	{
		$pageTitle = 'Profile';
		$admin = Auth::guard('admin')->user();
		return view('admin::profile', compact('pageTitle', 'admin'));
	}

	public function profileUpdate(Request $request)
	{
		$notify = [];
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])]
		]);
		$user = Auth::guard('admin')->user();

		if ($request->hasFile('image')) {
			try {
				$old = $user->image ?: null;
				$user->image = fileUploader($request->image, getFilePath('adminProfile'), getFileSize('adminProfile'), $old);
			} catch (\Exception) {
				$notify[] = ['error', 'Image could not be uploaded.'];
				return back()->withNotify($notify);
			}
		}

		$user->name = $request->name;
		$user->email = $request->email;
		$user->save();
		$notify[] = ['success', 'Your profile has been updated.'];
		return redirect()->route('admin.profile')->withNotify($notify);
	}

	public function password()
	{
		$pageTitle = 'Password Setting';
		$admin = Auth::guard('admin')->user();
		return view('admin::password', compact('pageTitle', 'admin'));
	}

	public function passwordUpdate(Request $request)
	{
		$notify = [];
		$this->validate($request, [
			'old_password' => 'required',
			'password' => 'required|min:5|confirmed',
		]);

		$user = Auth::guard('admin')->user();
		if (!Hash::check($request->old_password, $user->password)) {
			$notify[] = ['error', 'Password do not match !!'];
			return back()->withNotify($notify);
		}
		$user->password = bcrypt($request->password);
		$user->save();
		$notify[] = ['success', 'Password changed successfully.'];
		return redirect()->route('admin.password')->withNotify($notify);
	}

	public function notifications()
	{
		$notifications = AdminNotification::orderBy('id', 'desc')->paginate();
		$pageTitle = 'Notifications';
		return view('admin::notifications', compact('pageTitle', 'notifications'));
	}

	public function notificationRead($id)
	{
		$notification = AdminNotification::findOrFail($id);
		$notification->is_read = 1;
		$notification->save();
		return redirect($notification->click_url);
	}

	public function readAll()
	{
		$notify = [];
		AdminNotification::where('is_read', 0)->update([
			'is_read' => 1
		]);
		$notify[] = ['success', 'Notifications read successfully'];
		return back()->withNotify($notify);
	}

	public function systemInfo()
	{
		$metadata = json_decode(file_get_contents(dirname(__DIR__, 4) . '/composer.json'));

		$laravelVersion = app()->version();
		$timeZone = config('app.timezone');
		$pageTitle = 'Application Information';
		$adminVersion = $metadata->version;
		return view('admin::system.info', compact('pageTitle', 'laravelVersion', 'timeZone', 'adminVersion'));
	}

	public function systemServerInfo()
	{
		$currentPHP = phpversion();
		$pageTitle = 'Server Information';
		$serverDetails = $_SERVER;
		return view('admin::system.server', compact('pageTitle', 'currentPHP', 'serverDetails'));
	}

	public function optimize()
	{
		$pageTitle = 'Clear System Cache';
		return view('admin::system.optimize', compact('pageTitle'));
	}

	public function optimizeClear()
	{
		Artisan::call('optimize:clear');
		$notify[] = ['success', 'Cache cleared successfully'];
		return back()->withNotify($notify);
	}
}
