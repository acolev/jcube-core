<?php

namespace jCube\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use jCube\Constants\Status;
use App\Http\Controllers\Controller;
use jCube\Models\Config;
use jCube\Notify\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use jCube\Models\NotificationTemplate;

class NotificationController extends Controller
{
	public function global()
	{
		$pageTitle = 'Global Template for Notification';
		$general = getConfig('notify');
		return view('admin::notification.global_template', compact('pageTitle', 'general'));
	}

	public function templates()
	{
		$pageTitle = 'Notification Templates';
		$templates = NotificationTemplate::orderBy('name')->get();
		return view('admin::notification.templates', compact('pageTitle', 'templates'));
	}

	public function templateEdit($id)
	{
		$template = NotificationTemplate::findOrFail($id);
		$pageTitle = $template->name;
		return view('admin::notification.edit', compact('pageTitle', 'template'));
	}

	public function templateUpdate(Request $request, $id)
	{
		$request->validate([
			'subject' => 'required|string|max:255',
			'email_body' => 'required',
			'sms_body' => 'required',
		]);
		$template = NotificationTemplate::findOrFail($id);
		$template->subj = $request->subject;
		$template->email_body = $request->email_body;
		$template->email_status = $request->email_status ? Status::ENABLE : Status::DISABLE;
		$template->sms_body = $request->sms_body;
		$template->sms_status = $request->sms_status ? Status::ENABLE : Status::DISABLE;
		$template->save();

		$notify[] = ['success', 'Notification template updated successfully'];
		Artisan::call('optimize:clear');
		return back()->with('notify', $notify);
	}

	public function emailSetting()
	{
		$pageTitle = 'Email Notification Settings';
		$general = getConfig('notify');
		return view('admin::notification.email_setting', compact('pageTitle', 'general'));
	}

	public function emailSettingUpdate(Request $request)
	{
		$request->validate([
			'email_method' => 'required|in:php,smtp,sendgrid,mailjet',
			'host' => 'required_if:email_method,smtp',
			'port' => 'required_if:email_method,smtp',
			'username' => 'required_if:email_method,smtp',
			'password' => 'required_if:email_method,smtp',
			'enc' => 'required_if:email_method,smtp',
			'appkey' => 'required_if:email_method,sendgrid',
			'public_key' => 'required_if:email_method,mailjet',
			'secret_key' => 'required_if:email_method,mailjet',
		], [
			'host.required_if' => ':attribute is required for SMTP configuration',
			'port.required_if' => ':attribute is required for SMTP configuration',
			'username.required_if' => ':attribute is required for SMTP configuration',
			'password.required_if' => ':attribute is required for SMTP configuration',
			'enc.required_if' => ':attribute is required for SMTP configuration',
			'appkey.required_if' => ':attribute is required for SendGrid configuration',
			'public_key.required_if' => ':attribute is required for Mailjet configuration',
			'secret_key.required_if' => ':attribute is required for Mailjet configuration',
		]);
		if ($request->email_method == 'php') {
			$data['name'] = 'php';
		} else if ($request->email_method == 'smtp') {
			$request->merge(['name' => 'smtp']);
			$data = $request->only('name', 'host', 'port', 'enc', 'username', 'password', 'driver');
		} else if ($request->email_method == 'sendgrid') {
			$request->merge(['name' => 'sendgrid']);
			$data = $request->only('name', 'appkey');
		} else if ($request->email_method == 'mailjet') {
			$request->merge(['name' => 'mailjet']);
			$data = $request->only('name', 'public_key', 'secret_key');
		}
		$config = Config::where('slug', 'mail_config')->first();
		$config->value = json_encode($data, JSON_UNESCAPED_UNICODE);
		$config->save();
		$notify[] = ['success', 'Email settings updated successfully'];
		Artisan::call('optimize:clear');
		return back()->with('notify', $notify);
	}

	public function emailTest(Request $request)
	{
		$request->validate([
			'email' => 'required|email'
		]);

		$general = gs();
		$nc = getConfig('notify');
		$system = getConfig('system');
		$config = $nc->mail_config;
		$receiverName = explode('@', $request->email)[0];
		$subject = strtoupper($config->name) . ' Configuration Success';
		$message = 'Your email notification setting is configured successfully for ' . $general->site_name;

		if ($system->en) {
			$user = [
				'username' => $request->email,
				'email' => $request->email,
				'fullname' => $receiverName,
			];
			notify($user, 'DEFAULT', [
				'subject' => $subject,
				'message' => $message,
			], ['email'], false);
		} else {
			$notify[] = ['info', 'Please enable from general settings'];
			$notify[] = ['error', 'Your email notification is disabled'];
			return back()->with('notify', $notify);
		}

		if (session('mail_error')) {
			$notify[] = ['error', session('mail_error')];
		} else {
			$notify[] = ['success', 'Email sent to ' . $request->email . ' successfully'];
		}

		return back()->with('notify', $notify);
	}

	public function smsSetting()
	{
		$pageTitle = 'SMS Notification Settings';
		$general = getConfig('notify');
		return view('admin::notification.sms_setting', compact('pageTitle', 'general'));
	}

	public function smsSettingUpdate(Request $request)
	{
		$request->validate([
			'sms_method' => 'required|in:clickatell,infobip,messageBird,nexmo,smsBroadcast,twilio,textMagic,custom',
			'clickatell_api_key' => 'required_if:sms_method,clickatell',
			'message_bird_api_key' => 'required_if:sms_method,messageBird',
			'nexmo_api_key' => 'required_if:sms_method,nexmo',
			'nexmo_api_secret' => 'required_if:sms_method,nexmo',
			'infobip_username' => 'required_if:sms_method,infobip',
			'infobip_password' => 'required_if:sms_method,infobip',
			'sms_broadcast_username' => 'required_if:sms_method,smsBroadcast',
			'sms_broadcast_password' => 'required_if:sms_method,smsBroadcast',
			'text_magic_username' => 'required_if:sms_method,textMagic',
			'apiv2_key' => 'required_if:sms_method,textMagic',
			'account_sid' => 'required_if:sms_method,twilio',
			'auth_token' => 'required_if:sms_method,twilio',
			'from' => 'required_if:sms_method,twilio',
			'custom_api_method' => 'required_if:sms_method,custom|in:get,post',
			'custom_api_url' => 'required_if:sms_method,custom',
		]);

		$data = [
			'name' => $request->sms_method,
			'clickatell' => [
				'api_key' => $request->clickatell_api_key,
			],
			'infobip' => [
				'username' => $request->infobip_username,
				'password' => $request->infobip_password,
			],
			'message_bird' => [
				'api_key' => $request->message_bird_api_key,
			],
			'nexmo' => [
				'api_key' => $request->nexmo_api_key,
				'api_secret' => $request->nexmo_api_secret,
			],
			'sms_broadcast' => [
				'username' => $request->sms_broadcast_username,
				'password' => $request->sms_broadcast_password,
			],
			'twilio' => [
				'account_sid' => $request->account_sid,
				'auth_token' => $request->auth_token,
				'from' => $request->from,
			],
			'text_magic' => [
				'username' => $request->text_magic_username,
				'apiv2_key' => $request->apiv2_key,
			],
			'custom' => [
				'method' => $request->custom_api_method,
				'url' => $request->custom_api_url,
				'headers' => [
					'name' => $request->custom_header_name ?? [],
					'value' => $request->custom_header_value ?? [],
				],
				'body' => [
					'name' => $request->custom_body_name ?? [],
					'value' => $request->custom_body_value ?? [],
				],
			],
		];
		$config = Config::where('slug', 'sms_config')->first();
		$config->value = json_encode($data, JSON_UNESCAPED_UNICODE);
		$config->save();
		$notify[] = ['success', 'Sms settings updated successfully'];
		Artisan::call('optimize:clear');
		return back()->with('notify', $notify);
	}

	public function smsTest(Request $request)
	{
		$request->validate(['mobile' => 'required']);
		$general = getConfig('notify');
		if ($general->sn == 1) {
			$sendSms = new Sms;
			$sendSms->mobile = $request->mobile;
			$sendSms->receiverName = ' ';
			$sendSms->message = 'Your sms notification setting is configured successfully for ' . $general->site_name;
			$sendSms->subject = ' ';
			$sendSms->send();
		} else {
			$notify[] = ['info', 'Please enable from general settings'];
			$notify[] = ['error', 'Your sms notification is disabled'];
			return back()->with('notify', $notify);
		}

		if (session('sms_error')) {
			$notify[] = ['error', session('sms_error')];
		} else {
			$notify[] = ['success', 'SMS sent to ' . $request->mobile . 'successfully'];
		}

		return back()->with('notify', $notify);
	}

}
