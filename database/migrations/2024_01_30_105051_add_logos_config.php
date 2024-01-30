<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use jCube\Models\Config;
use jCube\Models\ConfigCategory;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    $cat = new ConfigCategory();
    $cat->slug = 'logos';
    $cat->title = 'Logo & favicon';
    $cat->description = 'Change logos and favicon';
    $cat->icon = 'las la-images';
    $cat->save();
    
    $data = [
      [
        'slug' => 'logo_dark',
        'category' => 'logos',
        'name' => 'Logo Dark',
        'type' => 'image',
        'value' => '',
        'variants' => [
          'size' => '100x17',
          'bg' => 'light',
        ],
      ],
      [
        'slug' => 'logo',
        'category' => 'logos',
        'name' => 'Logo Light',
        'type' => 'image',
        'value' => '',
        'variants' => [
          'size' => '100x17',
          'bg' => 'dark',
        ],
      ],
      [
        'slug' => 'favicon',
        'category' => 'logos',
        'name' => 'Favicon',
        'type' => 'image',
        'value' => '',
        'variants' => [
          'size' => '32x32',
          'bg' => 'light',
        ],
      ],
    ];
    
    foreach ($data as $item) {
      $conf = new Config();
      foreach ($item as $f => $v) {
        $conf->$f = $v;
      }
      $conf->save();
    }
  }
  
  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    ConfigCategory::where('slug', 'logos')->delete();
    Config::where('category', 'logos')->delete();
  }
};
