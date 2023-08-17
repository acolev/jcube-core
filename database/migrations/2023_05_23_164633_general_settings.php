<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('site_name', 40)->default(null);
            $table->string('email_from', 40)->default(null);
            $table->text('email_template')->default(null);
            $table->string('sms_body', 255)->default(null);
            $table->string('sms_from', 255)->default(null);
            $table->text('mail_config')->default(null)->comment('email configuration');
            $table->text('sms_config')->default(null)->comment('sms configuration');
            $table->string('active_template', 40)->default('basic');
            $table->json('data_values');
            $table->timestamps();
        });

        if (class_exists(jCube\Models\GeneralSetting::class)) {
            $settings = new jCube\Models\GeneralSetting();
            $settings->site_name = 'My Website';
            $settings->email_from = 'info@example.com';

            $settings->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
