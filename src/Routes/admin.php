<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->group(function () {
	Route::get('/', 'LoginController@showLoginForm')->name('login');
	Route::post('/', 'LoginController@login')->name('login');
	Route::get('logout', 'LoginController@logout')->name('logout');
	// Admin Password Reset
	Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
	Route::post('password/reset', 'ForgotPasswordController@sendResetCodeEmail');
	Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify.code');
	Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.form');
	Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
});

Route::middleware('admin')->group(function () {
	Route::controller('AdminController')->group(function () {
		Route::get('dashboard', 'dashboard')->name('dashboard');

		Route::middleware(['2fa:admin'])->group(function () {
			Route::get('profile', 'profile')->name('profile');
			Route::post('profile', 'profileUpdate')->name('profile.update');
			Route::get('password', 'password')->name('password');
			Route::post('password', 'passwordUpdate')->name('password.update');

			//staff route
			Route::controller('StaffController')->middleware('permission:Manage Staff')->name('staff.')->prefix('staff')->group(function () {
				Route::get('list', 'list')->name('index');
				Route::post('save/{id?}', 'save')->name('save');
				Route::post('remove/{id}', 'remove')->name('remove');
			});

			Route::controller('GeneralSettingController')->group(function () {

				// General Setting
				Route::middleware('permission:Manage General Setting')->group(function () {
					Route::get('general-setting', 'index')->name('setting.index');
					Route::post('general-setting', 'update')->name('setting.update');
				});

				//configuration
				Route::middleware('permission:Manage System Configuration')->group(function () {
					Route::get('setting/system-configuration', 'systemConfiguration')->name('setting.system.configuration');
					Route::post('setting/system-configuration', 'systemConfigurationSubmit');
				});

				// Logo-Icon
				Route::middleware('permission:Manage Logo And Favicon')->group(function () {
					Route::get('setting/logo-icon', 'logoIcon')->name('setting.logo.icon');
					Route::post('setting/logo-icon', 'logoIconUpdate')->name('setting.logo.icon');
				});

				//Custom CSS
				Route::middleware('permission:Others')->group(function () {
					Route::get('custom-css', 'customCss')->name('setting.custom.css');
					Route::post('custom-css', 'customCssSubmit');
				});

				//Cookie
				Route::middleware('permission:Manage GDPR Cookie')->group(function () {
					Route::get('cookie', 'cookie')->name('setting.cookie');
					Route::post('cookie', 'cookieSubmit');
				});

				//maintenance_mode
				Route::middleware('permission:Manage Maintenance Mode')->group(function () {
					Route::get('maintenance-mode', 'maintenanceMode')->name('maintenance.mode');
					Route::post('maintenance-mode', 'maintenanceModeSubmit');
				});
			});

		});

		//2FA
		Route::get('twofactor', 'show2faForm')->name('twofactor');
		Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
		Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

		// 2FA Authorization
		Route::controller('AuthorizationController')->group(function () {
			Route::get('authorization', 'authorizeForm')->name('authorization');
			Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
			Route::post('verify-email', 'emailVerification')->name('verify.email');
			Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
			Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
		});

		//Notification
		Route::get('notifications', 'notifications')->name('notifications');
		Route::get('notification/read/{id}', 'notificationRead')->name('notification.read');
		Route::get('notifications/read-all', 'readAll')->name('notifications.readAll');

		//System Information
		Route::name('system.')
			->prefix('system')
			->group(function () {
				Route::get('info', 'systemInfo')->name('info');
				Route::get('server-info', 'systemServerInfo')->name('server.info');
				Route::get('optimize', 'optimize')->name('optimize');
				Route::get('optimize-clear', 'optimizeClear')->name('optimize.clear');
			});
	});
});
