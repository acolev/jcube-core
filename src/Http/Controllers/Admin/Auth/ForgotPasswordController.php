<?php

namespace jCube\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use jCube\Models\Admin;
use jCube\Models\AdminPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
	/*
			|--------------------------------------------------------------------------
			| Password Reset Controller
			|--------------------------------------------------------------------------
			|
			| This controller is responsible for handling password reset emails and
			| includes a trait which assists in sending these notifications from
			| your application to your users. Feel free to explore this trait.
			|
			*/

//    use backend\SendsPasswordResetEmails;

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
	 * Display the form to request a password reset link.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLinkRequestForm()
	{
		$pageTitle = 'Account Recovery';

		return view('admin::auth.passwords.email', compact('pageTitle'));
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

	public function sendResetCodeEmail(Request $request)
	{
		$notify = [];
		$this->validate($request, [
			'email' => 'required|email',
		]);

		$user = Admin::where('email', $request->email)->first();
		if (!$user) {
			return back()->withErrors(['Email Not Available']);
		}

		$code = verificationCode(6);
		$adminPasswordReset = new AdminPasswordReset();
		$adminPasswordReset->email = $user->email;
		$adminPasswordReset->token = $code;
		$adminPasswordReset->status = 0;
		$adminPasswordReset->created_at = date('Y-m-d h:i:s');
		$adminPasswordReset->save();

		$userIpInfo = getIpInfo();
		$userBrowser = osBrowser();

		notify($user, 'PASS_RESET_CODE', [
			'code' => $code,
			'operating_system' => $userBrowser['os_platform'],
			'browser' => $userBrowser['browser'],
			'ip' => $userIpInfo['ip'],
			'time' => $userIpInfo['time']
		], ['email'], false);


		$pageTitle = 'Account Recovery';
		$notify[] = ['success', 'Password reset email sent successfully'];

		return view('admin::auth.passwords.code_verify', compact('pageTitle', 'notify'));
	}

	public function verifyCode(Request $request)
	{
		$notify = [];
		$request->validate(['code' => 'required']);
		$notify[] = ['success', 'You can change your password.'];
		$code = str_replace(' ', '', $request->code);

		return redirect()->route('admin.password.reset.form', $code)->with('notify', $notify);
	}
}
