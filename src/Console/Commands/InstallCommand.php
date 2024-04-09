<?php

namespace jCube\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\{confirm, intro, info, spin, warning};


class InstallCommand extends Command
{
  protected $name = 'jcube:install';
  
  protected $description = 'Install all of the jCube files';
  
  public function handle()
  {
    $metadata = json_decode(file_get_contents(dirname(__DIR__, 3) . '/composer.json'));
    spin(function (): void {
      $this
        ->executeCommand('vendor:publish', ['--tag' => 'core-config'])
        ->executeCommand('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider'])
        ->executeCommand('make:create-admin-layout', ['name' => 'layout'])
        ->executeCommand('jcube:notify');
    }, 'Installation completed');
    
    if (confirm('Would you like run migrate?', false)) {
      $this->executeCommand('migrate');
    }
    
    warning("To create a user, run 'artisan jcube:admin'");
    info("To start the embedded server, run 'artisan serve'");
    
  }
  
  /**
   * @return $this
   */
  private function executeCommand(string $command, array $parameters = []): self
  {
    try {
      $result = $this->callSilent($command, $parameters);
    } catch (\Exception $exception) {
      $result = 1;
      $this->alert($exception->getMessage());
    }
    
    if ($result) {
      $parameters = http_build_query($parameters, '', ' ');
      $parameters = str_replace('%5C', '/', $parameters);
      $this->alert("An error has occurred. The '{$command} {$parameters}' command was not executed");
    }
    
    return $this;
  }
  
}
