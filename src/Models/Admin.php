<?php

namespace jCube\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
  use HasRoles;
  
  protected $hidden = [
    'password', 'remember_token',
  ];
  
  protected $casts = [
    'access_permissions' => 'array',
  ];
  
  //    use GlobalStatus;
  
  public function access($permission)
  {
    return $this->status || $this->can($permission);
  }
}
