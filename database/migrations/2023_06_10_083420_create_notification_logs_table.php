<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('admin_id')->default(0);
            $table->string('sender', 40)->nullable();
            $table->string('sent_from', 40)->nullable();
            $table->string('sent_to', 40)->nullable();
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->string('notification_type', 40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_logs');
    }
};
