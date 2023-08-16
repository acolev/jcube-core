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
	    Schema::create('history', function (Blueprint $table) {
		    $table->id();
		    $table->bigInteger('uid');
		    $table->integer('object_id');
		    $table->string('type', 50);
		    $table->string('action', 50);
		    $table->json('history_data', 50);
		    $table->timestamp('created_at')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
	    Schema::dropIfExists('history');
    }
};
