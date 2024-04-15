<?php

namespace jCube\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ModuleCommand extends Command
{
  protected $signature = 'jcube:module {action} {name?}';
  protected $description = 'Install and update modules';
  
  public function handle()
  {
    $action = $this->argument('action');
    $name = $this->argument('name');
    $folder = ucfirst(basename($name));
    
    switch ($action) {
      case "install":
      case "i":
        $this->installModule($name, $folder);
        break;
      case "update":
      case "u":
        $this->updateModule($name);
        break;
      case "disable":
      case "d":
        $this->disableModule($folder);
        break;
      case "enable":
      case "e":
        $this->enableModule($folder);
        break;
      default:
        $this->error("Unknown command: " . $action);
        break;
    }
  }
  
  private function installModule($name, $folder)
  {
    $this->info('Installing: ' . $name);
    $process = new Process(['git', 'clone', $this->genUrl($name), "./Modules/$folder"]);
    $process->setWorkingDirectory(base_path());
    $process->run();
    
    if ($process->isSuccessful() && is_dir("./Modules/$folder")) {
      \Artisan::call("module:enable $folder");
      $this->info($process->getOutput());
    } else {
      $this->error("Failed to install $folder");
    }
  }
  
  private function updateModule($name)
  {
    if (!$name) {
      $modules = glob(base_path('Modules/*'), GLOB_ONLYDIR);
      foreach ($modules as $module) {
        $this->updateModule(basename($module));
      }
      return;
    }
    
    $this->info('Updating: ' . $name);
    $process = new Process(['git', 'pull'], base_path("Modules/$name"));
    $process->run();
    
    if (!$process->isSuccessful()) {
      $this->error("Failed to update $name: " . $process->getErrorOutput());
    } else {
      $this->info($process->getOutput());
    }
  }
  
  private function disableModule($folder)
  {
    \Artisan::call("module:disable $folder");
  }
  
  private function enableModule($folder)
  {
    \Artisan::call("module:enable $folder");
  }
  
  private function genUrl($name)
  {
    return "https://{$this->env('MODULES_CREDENTIALS')}@" .
      str_replace('https://', '', $this->env('MODULES_REPOSITORY')) .
      "/$name.git";
  }
  
  private function env($key)
  {
    return env($key, '');
  }
}
