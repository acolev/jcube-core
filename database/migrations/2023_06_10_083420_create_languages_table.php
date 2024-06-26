<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('languages', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name', 40)->nullable();
      $table->string('code', 40)->nullable();
      $table->boolean('is_default')->default(false)->comment('0: not default language, 1: default language');
      $table->timestamps();
    });
    
    $dlang = new \jCube\Models\Language();
    $dlang->name = 'English';
    $dlang->code = 'en';
    $dlang->is_default = true;
    $dlang->save();
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('languages');
  }
};
