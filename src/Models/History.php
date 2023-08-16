<?php

namespace jCube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class History extends Model
{
    public $casts = [
        'history_data'=>'object'
    ];

}
