<?php

namespace jCube\Http\Controllers\Admin;

use GuzzleHttp\Psr7\Request;
use jCube\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
  
  public function list()
  {
    $pageTitle = "Manage Staff's Roles";
    
    $roles = Role::paginate();
    
    return view('admin::roles.list', compact('pageTitle', 'roles'));
  }
  
  public function create()
  {
    $pageTitle = "Edit Staff's Role";
    
    $guards = [];
    $permissions = Permission::get();
    $permissions->map(function ($item) {
      list($item->module, $item->action) = explode(':', $item->name);
      return $item;
    });
    $permissions = $permissions->groupBy('module');
    
    foreach (config('auth.guards') as $k => $item) {
      if ($item['driver'] === 'session') $guards[$k] = ucfirst($k);
    }
    
    return view('admin::roles.add', compact('pageTitle', 'guards', 'permissions'));
  }
  
  public function edit(Role $id)
  {
    $pageTitle = "Edit Staff's Role";
    
    $role = $id;
    $guards = [];
    $permissions = Permission::get();
    $permissions->map(function ($item) {
      list($item->module, $item->action) = explode(':', $item->name);
      return $item;
    });
    $permissions = $permissions->groupBy('module');
    
    foreach (config('auth.guards') as $k => $item) {
      if ($item['driver'] === 'session') $guards[$k] = ucfirst($k);
    }
    
    return view('admin::roles.edit', compact('pageTitle', 'role', 'guards', 'permissions'));
  }
  
  public function save(Role $id)
  {
    $req = request();
    
    $role = $id;
    $isNew = !$role->exists;
    $validation = ['name' => 'required',];
    if ($isNew) $validation['guard_name'] = 'required';
    $req->validate($validation);
    
    $role->name = $req->name;
    $role->guard_name = 'admin';
    $role->save();
    
    $perm = array_filter($req->permissions, fn($item) => !!$item);
    $role->syncPermissions(array_keys($perm));
    
    if (!$isNew) {
      $notify[] = ['success', 'Role updated successfully'];
      return back()->with('notify', $notify);
    } else {
      $notify[] = ['success', 'Role created successfully'];
      return to_route('admin.roles.index')->with('notify', $notify);
    }
  }
  
  public function remove(Role $id)
  {
    $id->delete();
    $notify[] = ['success', 'Role deleted successfully'];
    
    return back()->with('notify', $notify);
  }
}
