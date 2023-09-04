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
    Schema::table('configs', function (Blueprint $table) {
      $table->bigIncrements('id')->first();
    });
    Schema::table('config_categories', function (Blueprint $table) {
      $table->bigIncrements('id')->first();
    });
  }
  
  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('configs', function (Blueprint $table) {
      $table->dropColumn('id');
    });
    Schema::table('config_categories', function (Blueprint $table) {
      $table->dropColumn('id');
    });
  }
};
