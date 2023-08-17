<?php

namespace jCube\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $casts = [
        'history_data' => 'object',
    ];
}
