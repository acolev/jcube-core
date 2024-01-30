<?php

namespace jCube\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use jCube\Http\Controllers\Controller;
use jCube\Lib\GoogleAuthenticator;
use App\Models\Language;
use jCube\Rules\FileTypeValidate;

class AdminController extends Controller
{
  public function dashboard()
  {
    $pageTitle = 'Dashboard';
    $admin = Auth::guard('admin')->user();

//    dump($admin->getAllPermissions());
    return view('admin::dashboard', compact('pageTitle'));
  }
  
  public function profile()
  {
    $pageTitle = 'Profile';
    $admin = Auth::guard('admin')->user();
    $languages = [];
    $part = 'profile';
    
    if (class_exists(Language::class)) {
      $languages = Language::pluck('name', 'code');
    }
    
    return view('admin::profile.index', compact(
      'pageTitle',
      'admin',
      'languages',
      'part'
    ));
  }
  
  public function profileUpdate(Request $request)
  {
    $notify = [];
    $this->validate($request, [
      'name' => 'nullable|string',
      'email' => 'nullable|email',
      'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
    ]);
    $user = Auth::guard('admin')->user();
    
    if ($request->hasFile('image')) {
      try {
        $old = $user->image ?: null;
        $user->image = fileUploader($request->image, getFilePath('adminProfile'), getFileSize('adminProfile'), $old);
      } catch (\Exception) {
        $notify[] = ['error', 'Image could not be uploaded.'];
        
        return back()->with('notify', $notify);
      }
    }
    
    if (isset($request->name)) $user->name = $request->name;
    if (isset($request->last_name)) $user->last_name = $request->last_name;
    if (isset($request->email)) $user->email = $request->email;
    if (isset($request->lang)) $user->lang = $request->lang;
    if (isset($request->phone)) $user->phone = $request->phone;
//    if (isset($request->job_title))  $user->job_title = $request->job_title;

    $user->save();
    $notify[] = ['success', 'Your profile has been updated.'];
    
    return redirect()->route('admin.profile')->with('notify', $notify);
  }
  
  public function show2faForm()
  {
    $general = gs();
    $ga = new GoogleAuthenticator();
    $admin = auth()->guard('admin')->user();
    $secret = $ga->createSecret();
    $qrCodeUrl = $ga->getQRCodeGoogleUrl($admin->username . '@' . $general->site_name, $secret);
    $pageTitle = '2FA Setting';
    $part = 'twofactor';
    
    return view('admin::profile.index', compact(
      'pageTitle',
      'secret',
      'qrCodeUrl',
      'admin',
      'part'
    ));
  }
  
  public function create2fa(Request $request)
  {
    $user = auth()->guard('admin')->user();
    $this->validate($request, [
      'key' => 'required',
      'code' => 'required',
    ]);
    $response = verifyG2fa($user, $request->code, $request->key);
    if ($response) {
      $user->tsc = $request->key;
      $user->ts = 1;
      $user->save();
      $notify[] = ['success', 'Google authenticator activated successfully'];
      
      return back()->with('notify', $notify);
    } else {
      $notify[] = ['error', 'Wrong verification code'];
      
      return back()->with('notify', $notify);
    }
  }
  
  public function disable2fa(Request $request)
  {
    $this->validate($request, [
      'code' => 'required',
    ]);
    
    $user = auth()->guard('admin')->user();
    $response = verifyG2fa($user, $request->code);
    if ($response) {
      $user->tsc = null;
      $user->ts = 0;
      $user->save();
      $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
    } else {
      $notify[] = ['error', 'Wrong verification code'];
    }
    
    return back()->with('notify', $notify);
  }
  
  
  public function password()
  {
    $pageTitle = 'Password Setting';
    $admin = Auth::guard('admin')->user();
    $part = 'password';
    
    return view('admin::profile.index', compact('pageTitle', 'admin', 'part'));
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
      
      return back()->with('notify', $notify);
    }
    $user->password = bcrypt($request->password);
    $user->save();
    $notify[] = ['success', 'Password changed successfully.'];
    
    return redirect()->route('admin.password')->with('notify', $notify);
  }
  
  public function optimize()
  {
    Artisan::call('optimize:clear');
    $notify[] = ['success', 'Cache cleared successfully'];
    
    return back()->with('notify', $notify);
  }
}
