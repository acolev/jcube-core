<?php

namespace jCube\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
	protected $casts = [
		'shortcodes' => 'object'
	];

	protected $fillable = ['act', 'name', 'subj', 'email_body', 'sms_body', 'shortcodes', 'email_status', 'sms_status'];

}