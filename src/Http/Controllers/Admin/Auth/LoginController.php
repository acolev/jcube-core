<?php

namespace jCube\Http\Controllers\Admin\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jCube\Constants\Status;
use jCube\Http\Controllers\Controller;

class LoginController extends Controller
{
  use AuthenticatesUsers;
  
  public $redirectTo = 'admin';
  
  public function __construct()
  {
    $this->middleware('admin.guest')->except('logout');
  }
  
  public function showLoginForm()
  {
    $pageTitle = 'Admin Login';
    
    return view('admin::auth.login', compact('pageTitle'));
  }
  
  protected function guard()
  {
    return Auth::guard('admin');
  }
  
  public function username()
  {
    return 'username';
  }
  
  public function login(Request $request)
  {
    $this->validateLogin($request);
    
    if (method_exists($this, 'hasTooManyLoginAttempts') &&
      $this->hasTooManyLoginAttempts($request)) {
      $this->fireLockoutEvent($request);
      
      return $this->sendLockoutResponse($request);
    }
    
    
    if ($this->attemptLogin($request)) {
      return $this->sendLoginResponse($request);
    }
    
    $this->incrementLoginAttempts($request);
    
    return $this->sendFailedLoginResponse($request);
  }
  
  public function logout(Request $request)
  {
    $this->guard()->logout();
    $request->session()->invalidate();
    
    return $this->loggedOut($request) ?: redirect('/admin');
  }
  
  public function resetPassword()
  {
    $pageTitle = 'Account Recovery';
    
    return view('admin::reset', compact('pageTitle'));
  }
  
  public function authenticated(Request $request, $user)
  {
    $user->tv = $user->ts == Status::VERIFIED ? Status::UNVERIFIED : Status::VERIFIED;
    $user->save();
    
    return redirect()->route('admin.dashboard');
  }
}
