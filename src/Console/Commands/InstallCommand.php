<?php

namespace jCube\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $name = 'jcube:install';

    protected $description = 'Install all of the jCube files';

    public function handle()
    {
        $metadata = json_decode(file_get_contents(dirname(__DIR__, 3).'/composer.json'));

        $this->comment('Installation started. Please wait...');
        $this->info('Version: '.$metadata->version);
        $this
            ->executeCommand('migrate')
            ->executeCommand('storage:link')
            ->executeCommand('vendor:publish', [
                '--tag' => 'core-config',
            ])
            ->showMeLove();

        $this->info('Completed!');
        $this->comment("To create a user, run 'artisan jcube:admin'");
        $this->line("To start the embedded server, run 'artisan serve'");
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

    /**
     * @return $this
     */
    private function showMeLove(): self
    {
        if (! $this->confirm('Would you like to show a little love by starting with ⭐')) {
            return $this;
        }

        $repo = 'https://gitlab.com/jcubegroup/jcube-core';

        match (PHP_OS_FAMILY) {
            'Darwin' => exec('open '.$repo),
            'Windows' => exec('start '.$repo),
            'Linux' => exec('xdg-open '.$repo),
            default => $this->line('You can find us at '.$repo),
        };

        $this->line('Thank you! It means a lot to us! 🙏');

        return $this;
    }
}
