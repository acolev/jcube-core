<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use jCube\Models\ConfigCategory;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('configs', function (Blueprint $table) {
			$table->id();
			$table->string('slug');
			$table->string('category');
			$table->string('name');
			$table->string('type')->default('string');
			$table->text('value')->nullable();
			$table->text('default')->nullable();
			$table->string('variants')->nullable();
			$table->text('text')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('configs');
	}
};
