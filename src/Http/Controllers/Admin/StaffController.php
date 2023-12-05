<?php

namespace jCube\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use jCube\Http\Controllers\Controller;
use jCube\Models\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
  public function list()
  {
    $pageTitle = 'Manage Staff';
    $staffs = Admin::latest('id')->paginate(getPaginate());
    $permissions = Permission::where('guard_name', 'admin')->get();
    $roles = Role::where('guard_name', 'admin')->pluck('name')->toArray();
    $roles = array_merge(...collect($roles)->map(fn($role) => [$role => $role]));
    $jobTitles = Admin::where('job_title' , '!=', null)->distinct()->pluck('job_title', 'job_title');

    $staffs->map(function ($item) {
      try {
        return $item['roles'] = array_map(fn($role) => $role['name'], $item->roles->toArray());
      } catch (\Exception $exception) {
        return $item['roles'];
      }
    });
    
    return view('admin::staff.list', compact('pageTitle', 'staffs', 'roles', 'permissions', 'jobTitles'));
  }
  
  public function save(Request $request, $id = 0)
  {
    $passwordValidation = $id ? 'nullable' : 'required|min:6';
    
    $request->validate([
      'name' => 'required',
      'password' => "$passwordValidation",
      'email' => 'required|email|unique:admins,email,' . $id,
      'username' => 'required|unique:admins,username,' . $id,
    ]);
    
    if ($id) {
      $admin = Admin::findOrFail($id);
      $message = 'Staff updated successfully';
    } else {
      $admin = new Admin();
      $admin->password = Hash::make($request->password);
      $message = 'Staff created successfully';
    }
    if ($request->hasFile('image')) {
      try {
        $old = $admin->image ?: null;
        $admin->image = fileUploader($request->image, getFilePath('adminProfile'), getFileSize('adminProfile'), $old);
      } catch (\Exception) {
        $notify[] = ['error', 'Image could not be uploaded.'];
        
        return back()->with('notify', $notify);
      }
    }
    
    $admin->name = $request->name;
    $admin->last_name = $request->last_name;
    $admin->email = $request->email;
    $admin->phone = $request->phone;
    $admin->username = $request->username;
    $admin->job_title = $request->job_title;
    $admin->status = $request->status;
    $admin->syncRoles(...$request->roles ?: []);
    
    $admin->save();
    
    $notify[] = ['success', $message];
    
    return back()->with('notify', $notify);
  }
  
  public function remove($id)
  {
    $admin = Admin::findOrFail($id);
    $admin->delete();
    $notify[] = ['success', 'Staff deleted successfully'];
    
    return back()->with('notify', $notify);
  }
}
