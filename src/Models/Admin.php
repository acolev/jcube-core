<?php

namespace jCube\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
  protected $appends = [
    'fullName',
  ];
  
  //    use GlobalStatus;
  
  public function fullName(): Attribute
  {
    return new Attribute(
      get: fn() => implode(' ', [$this->name, $this->last_name ?: $this->uaername])
    );
  }
  
  public function access($permission)
  {
    return $this->status || $this->can($permission);
  }
}
