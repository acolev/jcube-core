<?php

namespace jCube\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\intro;

class UpdateCommand  extends Command
{
  protected $name = 'jcube:update';
  
  public function handle()
  {
    $metadata = json_decode(file_get_contents(dirname(__DIR__, 3) . '/composer.json'));
    intro('Update core to version: ' . $metadata->version);

//    if(!class_exists(\jCube\Models\Admin::class)){
//      $this->call('make:jcube-model', ['name' => 'Admin']);
//    }
//    if(!class_exists(\jCube\Models\AdminPasswordReset::class)){
//      $this->call('make:jcube-model', ['name' => 'AdminPasswordReset']);
//    }
  }
  
}
