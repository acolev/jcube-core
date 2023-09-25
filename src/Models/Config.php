<?php

namespace jCube\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	public $timestamps = false;
	public $incrementing = false;
  
  public $casts = [
    "variants" => 'object'
  ];

  
  public function getRouteKeyName()
  {
    return 'slug';
  }
  
}
