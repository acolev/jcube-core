<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    $guard = ['guard_name' => 'admin'];
    $role = Role::create([...$guard, 'name' => 'Admin']);
    $permissions = [
      'Dashboard:Read',
      'Staff:Read',
      'Staff:Edit',
      'Staff:Drop',
      'Role:Read',
      'Role:Edit',
      'Role:Drop',
      'System:Read',
      'System:Edit',
      'Notification:Read',
      'Notification:Edit',
    ];
    
    foreach ($permissions as $perm) {
      $permission = Permission::create([...$guard, 'name' => $perm]);
      $role->givePermissionTo($permission);
    }
    
    $users = \jCube\Models\Admin::where('status', 1)->get();
    
    foreach ($users as $user) {
      $user->assignRole('admin');
    }
  }
  
  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
  
  }
};
