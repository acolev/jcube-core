<?php

namespace jCube\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthorizationController extends Controller
{
    protected function checkCodeValidity($admin, $addMin = 2)
    {
        if (! $admin->ver_code_send_at) {
            return false;
        }
        if ($admin->ver_code_send_at->addMinutes($addMin) < Carbon::now()) {
            return true;
        }

        return true;
    }

    public function authorizeForm()
    {
        $admin = auth()->guard('admin')->user();

        if (! $admin->tv) {
            $pageTitle = '2FA Verification';
        } else {
            return to_route('admin.dashboard');
        }

        return view('admin::auth.2fa', compact('admin', 'pageTitle'));

    }

    public function sendVerifyCode($type)
    {
        $admin = auth()->guard('admin')->user();

        if ($this->checkCodeValidity($admin)) {
            $targetTime = $admin->ver_code_send_at->addMinutes(2)->timestamp;
            $delay = $targetTime - time();
            throw ValidationException::withMessages(['resend' => 'Please try after '.$delay.' seconds']);
        }

        $admin->ver_code = verificationCode(6);
        $admin->ver_code_send_at = Carbon::now();
        $admin->save();

        if ($type == 'email') {
            $type = 'email';
            $notifyTemplate = 'EVER_CODE';
        } else {
            $type = 'sms';
            $notifyTemplate = 'SVER_CODE';
        }

        notify($admin, $notifyTemplate, [
            'code' => $admin->ver_code,
        ], [$type]);

        $notify[] = ['success', 'Verification code sent successfully'];

        return back()->withNotify($notify);
    }

    public function emailVerification(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $admin = auth()->guard('admin')->user();

        if ($admin->ver_code == $request->code) {
            $admin->ev = Status::VERIFIED;
            $admin->ver_code = null;
            $admin->ver_code_send_at = null;
            $admin->save();

            return to_route('admin.dashboard');
        }
        throw ValidationException::withMessages(['code' => 'Verification code didn\'t match!']);
    }

    public function mobileVerification(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $admin = auth()->guard('admin')->user();
        if ($admin->ver_code == $request->code) {
            $admin->sv = Status::VERIFIED;
            $admin->ver_code = null;
            $admin->ver_code_send_at = null;
            $admin->save();

            return to_route('admin.dashboard');
        }
        throw ValidationException::withMessages(['code' => 'Verification code didn\'t match!']);
    }

    public function g2faVerification(Request $request)
    {
        $admin = auth()->guard('admin')->user();
        $request->validate([
            'code' => 'required',
        ]);
        $response = verifyG2fa($admin, $request->code);
        if ($response) {
            $notify[] = ['success', 'Verification successful'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }

        return back()->withNotify($notify);
    }
}
