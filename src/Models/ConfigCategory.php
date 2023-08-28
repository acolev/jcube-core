<?php

namespace jCube\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigCategory extends Model
{
	public $timestamps = false;
	public $primaryKey = 'slug';
	public $incrementing = false;
}
