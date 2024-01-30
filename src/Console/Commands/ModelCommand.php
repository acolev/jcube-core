<?php

namespace jCube\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ModelCommand extends GeneratorCommand
{
  protected $name = 'make:jcube-model';
  protected $description = 'Create Admin model';
  
  
  public function getStub()
  {
    return dirname(__DIR__, 3) . '/stubs/models/' . $this->argument('name') . '.stub';
  }
  
  protected function getDefaultNamespace($rootNamespace): string
  {
    return $rootNamespace . '\Models';
  }
}
