<?php

namespace jCube\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use jCube\Http\Controllers\Controller;
use jCube\Models\Admin;

class StaffController extends Controller
{
    public function list()
    {
        $pageTitle = 'Manage Staff';
        $staffs = Admin::latest('id')->paginate(getPaginate());
        $permissions = config('admin.permission');

        return view('admin::staff.list', compact('pageTitle', 'staffs', 'permissions'));
    }

    public function save(Request $request, $id = 0)
    {
        $passwordValidation = $id ? 'nullable' : 'required|min:6';

        $request->validate([
            'name' => 'required',
            'password' => "$passwordValidation",
            'email' => 'required|email|unique:admins,email,'.$id,
            'username' => 'required|unique:admins,username,'.$id,
        ]);

        if ($id) {
            $admin = Admin::findOrFail($id);
            $message = 'Staff updated successfully';
        } else {
            $admin = new Admin();
            $admin->password = Hash::make($request->password);
            $message = 'Staff created successfully';
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->access_permissions = $request->permissions ?? [];
        $admin->save();

        $notify[] = ['success', $message];

        return back()->withNotify($notify);
    }

    public function remove($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        $notify[] = ['success', 'Staff deleted successfully'];

        return back()->withNotify($notify);
    }
}
