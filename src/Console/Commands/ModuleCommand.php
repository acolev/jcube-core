<?php

namespace jCube\Console\Commands;

use Illuminate\Console\Command;

class ModuleCommand extends Command
{
  protected $name = 'jcube:module';
  protected $signature = 'jcube:module {action} {name}';
  protected $description = 'Install and update modules';
  
  
  public function handle()
  {
    dd($this->argument('action'));
  }
}
