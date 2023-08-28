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
			$table->string('slug')->primary();
			$table->string('category');
			$table->string('name');
			$table->string('type')->default('string');
			$table->text('value');
			$table->text('default');
			$table->string('variants');
			$table->string('text');
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
