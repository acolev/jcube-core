<?php

namespace jCube\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	public $timestamps = false;
	public $primaryKey = 'slug';
	public $incrementing = false;

}
