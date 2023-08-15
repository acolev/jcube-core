<?php

namespace jCube\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

	protected $hidden = [
		'password', 'remember_token',
	];

	protected $casts = [
		'access_permissions' => 'array'
	];

//    use GlobalStatus;

	public function access($permission)
	{
		return $this->status || in_array(titleToKey($permission), $this->access_permissions ?? []);
	}
}
