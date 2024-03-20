<?php

use Illuminate\Database\Migrations\Migration;
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
		$cat->icon = 'ri-settings-line';
		$cat->save();

		$cat = new ConfigCategory();
		$cat->slug = 'system';
		$cat->title = 'System Configuration';
		$cat->description = 'System settings and configuration';
		$cat->icon = 'ri-server-line';
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
