<?php

namespace jCube\Http\Controllers\Admin\Auth;

use jCube\Http\Controllers\Controller;
use jCube\Models\Admin;
use jCube\Models\AdminPasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
	/*
			|--------------------------------------------------------------------------
			| Password Reset Controller
			|--------------------------------------------------------------------------
			|
			| This controller is responsible for handling password reset requests
			| and uses a simple trait to include this behavior. You're free to
			| explore this trait and override any methods you wish to tweak.
			|
			*/

	use ResetsPasswords;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	public $redirectTo = '/admin/dashboard';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('admin.guest');
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * If no token is present, display the link request form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showResetForm(Request $request, ?string $token)
	{
		$notify = [];
		$pageTitle = 'Account Recovery';
		$resetToken = AdminPasswordReset::where('token', $token)->where('status', 0)->first();

		if (!$resetToken) {
			$notify[] = ['error', 'Token not found!'];

			return redirect()->route('admin.password.reset')->withNotify($notify);
		}
		$email = $resetToken->email;

		return view('admin::auth.passwords.reset', compact('pageTitle', 'email', 'token'));
	}

	public function reset(Request $request)
	{
		$notify = [];
		$this->validate($request, [
			'email' => 'required|email',
			'token' => 'required',
			'password' => 'required|confirmed|min:4',
		]);

		$reset = AdminPasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();
		$user = Admin::where('email', $reset->email)->first();
		if ($reset->status == 1) {
			$notify[] = ['error', 'Invalid code'];

			return redirect()->route('admin.login')->withNotify($notify);
		}

		$user->password = bcrypt($request->password);
		$user->save();
		$reset->status = 1;
		$reset->save();

		$userIpInfo = getIpInfo();
		$userBrowser = osBrowser();
		notify($user, 'PASS_RESET_DONE', [
			'operating_system' => $userBrowser['os_platform'],
			'browser' => $userBrowser['browser'],
			'ip' => $userIpInfo['ip'],
			'time' => $userIpInfo['time'],
		], ['email'], false);

		$notify[] = ['success', 'Password changed'];

		return redirect()->route('admin.login')->withNotify($notify);
	}

	/**
	 * Get the broker to be used during password reset.
	 *
	 * @return \Illuminate\Contracts\Auth\PasswordBroker
	 */
	public function broker()
	{
		return Password::broker('admins');
	}

	/**
	 * Get the guard to be used during password reset.
	 *
	 * @return \Illuminate\contracts\Auth\StatefulGuard
	 */
	protected function guard()
	{
		return Auth::guard('admin');
	}
}
