<?php

namespace jCube\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\database\Eloquent\Model;

class AdminNotification extends Model
{
    use HasFactory;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
