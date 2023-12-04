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
      Schema::table('admins', function (Blueprint $table) {
        $table->tinyInteger('root')->default(0);
        $table->string('last_name')->nullable();
        $table->string('phone')->nullable();
        $table->string('job_title')->default('New Staff');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('admins', function (Blueprint $table) {
        $table->dropColumn('root');
        $table->dropColumn('last_name');
        $table->dropColumn('phone');
        $table->dropColumn('job_title');
      });
    }
};
