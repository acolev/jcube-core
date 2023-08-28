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
		$cat = new ConfigCategory();
		$cat->slug = 'general';
		$cat->title = 'General Settings';
		$cat->description = 'General settings and configuration';
		$cat->icon = 'la la-cog';
		$cat->save();

		$cat = new ConfigCategory();
		$cat->slug = 'system';
		$cat->title = 'System Configuration';
		$cat->description = 'System settings and configuration';
		$cat->icon = 'la la-database';
		$cat->save();
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		//
	}
};
