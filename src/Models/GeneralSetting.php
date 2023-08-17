<?php

namespace jCube\Models;

use Illuminate\database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $guarded = ['id'];

    protected $casts = ['mail_config' => 'object', 'sms_config' => 'object', 'data_values' => 'object'];

    public function scopeSitename($query, $pageTitle)
    {
        $pageTitle = empty($pageTitle) ? '' : ' - '.$pageTitle;

        return $this->site_name.$pageTitle;
    }
}
