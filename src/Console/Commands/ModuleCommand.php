<?php

namespace jCube\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\error;
use function Laravel\Prompts\intro;

class ModuleCommand extends Command
{
  protected $name = 'jcube:module';
  protected $signature = 'jcube:module {action} {name?}';
  protected $description = 'Install and update modules';
  
  
  public function handle()
  {
    $action = $this->argument('action');
    $name = $this->argument('name');
    $folder = ucfirst($name);
    switch ($action) {
      case "i":
      case "install":
        intro('Installing: ' . $name);
        exec('cd ./Modules && git clone ' . $this->genUrl($name) . ' ' . $folder, $output);
        if (is_dir('./Modules/' . $folder)) {
          \Artisan::call("module:enable {$folder}");
          $this->info(implode(' ', $output));
        } else {
          $this->info(implode(' ', ['Sorry I can\'t install the', $folder]));
        }
        exec('composer du');
        break;
      case "u":
      case "update":
        if (!$name) {
          $items = glob('Modules/*');
          if (is_array($items) && count($items)) {
            foreach ($items as $item) {
              $__name = explode('/', $item);
              unset($__name[0]);
              $__name = implode('/', $__name);
              intro('Updating: ' . $__name);
              exec('cd ./' . $item . ' && git pull', $output);
              $this->info(implode(' ', $output));
            }
          } else {
            error("Sorry I can't find any modules");
          }
          return '';
        }
        intro('Updating: ' . $name);
        exec('cd ./Modules/' . $name . ' && git pull', $output);
        $this->info(implode(' ', $output));
        break;
      case "d":
      case "disable":
        \Artisan::call("module:disable {$folder}");
        break;
      case "e":
      case "enable":
        \Artisan::call("module:enable {$folder}");
        break;
      default:
        error("Sorry I don't know command: " . $action);
        break;
    }
  }
  
  private function genUrl($name)
  {
    return implode([
      'https://',
      $_ENV['MODULES_CREDENTIALS'],
      '@',
      str_replace('https://', '', $_ENV['MODULES_REPOSITORY']),
      '/',
      $name . '.git',
    ]);
  }
}
