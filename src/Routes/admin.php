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
    Route::middleware('permission:Dashboard:Read')->group(function () {
      Route::get('dashboard', 'dashboard')->name('dashboard');
    });
    
    Route::middleware(['2fa:admin'])->group(function () {
      Route::get('profile', 'profile')->name('profile');
      Route::post('profile', 'profileUpdate')->name('profile.update');
      Route::get('password', 'password')->name('password');
      Route::post('password', 'passwordUpdate')->name('password.update');
      
      //staff route
      Route::controller('StaffController')->name('staff.')->prefix('staff')->group(function () {
        Route::get('list', 'list')->middleware('permission:Staff:Read')->name('index');
        Route::post('save/{id?}', 'save')->middleware('permission:Staff:Edit')->name('save');
        Route::post('remove/{id}', 'remove')->middleware('permission:Staff:Drop')->name('remove');
      });
      Route::controller('RolesController')->name('roles.')->prefix('roles')->group(function () {
        Route::get('/', 'list')->middleware('permission:Role:Read')->name('index');
        Route::get('add', 'create')->middleware('permission:Role:Edit')->name('create');
        Route::get('read/{id}', 'edit')->middleware('permission:Role:Read')->name('edit');
        Route::post('save/{id?}', 'save')->middleware('permission:Role:Edit')->name('save');
        Route::post('remove/{id}', 'remove')->middleware('permission:Role:Drop')->name('remove');
      });
      
      Route::controller('GeneralSettingController')->group(function () {
        // Logo-Icon
        Route::middleware('permission:System:Edit')->group(function () {
          Route::get('setting/logo-icon', 'logoIcon')->name('setting.logo.icon');
          Route::post('setting/logo-icon', 'logoIconUpdate')->name('setting.logo.icon');
        });
      });
      
      Route::controller('ConfigController')->group(function () {
        Route::get('configuration/{category}', 'index')->middleware('permission:System:Read')->name('config.view');
        Route::post('configuration/{category}', 'update')->middleware('permission:System:Edit')->name('config.update');
      });
      
      //Notification Setting
      Route::controller('NotificationController')
        ->middleware('permission:Notification:Read')
        ->name('setting.notification.')
        ->prefix('notification')->group(function () {
          //Template Setting
          Route::get('global', 'global')->name('global');
          Route::post('global/update', 'globalUpdate')->name('global.update');
          Route::get('templates', 'templates')->name('templates');
          Route::get('template/edit/{id}', 'templateEdit')->name('template.edit');
          Route::post('template/update/{id}', 'templateUpdate')->name('template.update');
          
          //Email Setting
          Route::get('email/setting', 'emailSetting')->name('email');
          Route::post('email/setting', 'emailSettingUpdate');
          Route::post('email/test', 'emailTest')->name('email.test');
          
          //SMS Setting
          Route::get('sms/setting', 'smsSetting')->name('sms');
          Route::post('sms/setting', 'smsSettingUpdate');
          Route::post('sms/test', 'smsTest')->name('sms.test');
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
    Route::get('optimize', 'optimize')->prefix('system')->name('system.optimize');
  });
});