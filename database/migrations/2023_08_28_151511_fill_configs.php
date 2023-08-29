<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use jCube\Models\Config;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $data = [
            [
                'slug' => 'site_name',
                'category' => 'general',
                'name' => 'Site Name',
                'type' => 'string',
                'value' => 'Grigo Academy',
                'default' => 'My website'
            ],
            [
                'slug' => 'meta_title',
                'category' => 'general',
                'name' => 'Meta Title Rule',
                'type' => 'string',
                'value' => '{{title}} - {{site_name}}',
                'default' => '{{title}} || {{site_name}}'
            ],

            [
                'slug' => 'email_from',
                'category' => 'notify',
                'name' => 'Email From',
                'type' => 'string',
                'value' => 'no-reply@grigo.academy',
                'default' => 'no-reply@example.com'
            ],
            [
                'slug' => 'email_template',
                'category' => 'notify',
                'name' => 'Email From',
                'type' => 'html',
                'value' => '',
                'default' => '{{message}}'
            ],
            [
                'slug' => 'sms_body',
                'category' => 'notify',
                'name' => 'SMS Body',
                'type' => 'text',
                'value' => '',
                'default' => '{{message}}'
            ],
            [
                'slug' => 'sms_from',
                'category' => 'notify',
                'name' => 'SMS From',
                'type' => 'string',
                'value' => 'Grigo.Academy',
                'default' => ''
            ],
            [
                'slug' => 'mail_config',
                'category' => 'notify',
                'name' => 'Mail Config',
                'type' => 'json',
                'value' => '',
                'default' => '{"name":"php"}'
            ],
            [
                'slug' => 'sms_config',
                'category' => 'notify',
                'name' => 'SMS Config',
                'type' => 'json',
                'value' => '',
                'default' => '{}'
            ],
            [
                'slug' => 'en',
                'category' => 'system',
                'name' => 'Email Notification',
                'type' => 'boolean',
                'value' => 1,
                'default' => 1,
                'text' => "If you enable this module, the system will send emails to users where needed. Otherwise, no email will be sent. <code>So be sure before disabling this module that, the system doesn't need to send any emails.</code>"
            ],
            [
                'slug' => 'ev',
                'category' => 'system',
                'name' => 'Email Verification',
                'type' => 'boolean',
                'value' => 1,
                'default' => 1,
                'text' => "If you enable <span class=\"fw-bold\">Email Verification</span>, users have to verify their email to access the dashboard. A 6-digit verification code will be sent to their email to be verified.<br><span class=\"fw-bold\"><i>Note:</i></span> <i>Make sure that the <span class=\"fw-bold\">Email Notification </span> module is enabled</i>"
            ],
            [
                'slug' => 'sn',
                'category' => 'system',
                'name' => 'SMS Notification',
                'type' => 'boolean',
                'value' => 0,
                'default' => 0,
                'text' => "If you enable this module, the system will send SMS to users where needed. Otherwise, no SMS will be sent. <code>So be sure before disabling this module that, the system doesn't need to send any SMS.</code>"
            ],
            [
                'slug' => 'sv',
                'category' => 'system',
                'name' => 'SMS Verification',
                'type' => 'boolean',
                'value' => 0,
                'default' => 0,
                'text' => "If you enable <span class=\"fw-bold\">Mobile Verification</span>, users have to verify their mobile to access the dashboard. A 6-digit verification code will be sent to their mobile to be verified.<br><span class=\"fw-bold\"><i>Note:</i></span> <i>Make sure that the <span class=\"fw-bold\">SMS Notification </span> module is enabled</i>"
            ],
        ];
        foreach ($data as $item) {
            $conf = new Config();
            foreach ($item as $f => $v) {
                $conf->$f = $v;
            }
            $conf->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
