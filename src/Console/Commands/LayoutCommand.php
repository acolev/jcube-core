<?php

namespace jCube\Console\Commands;

use Illuminate\Foundation\Console\ComponentMakeCommand;
use Illuminate\Foundation\Inspiring;

class LayoutCommand extends ComponentMakeCommand
{

	protected $name = 'make:create-admin-layout view';
	protected $description = 'Create admin\'s layout component';
	protected $type = 'Component';

	public function handle()
	{
		$this->writeView(function () {
			$this->components->info($this->type . ' created successfully.');
		});

		return;
	}

	protected function getStub()
	{
		$folder = dirname(__DIR__, 3) . '/stubs/components/admin/';
		return $folder . 'layout.stub';
	}

	protected function writeView($onSuccess = null)
	{
		$path = $this->viewPath(
			str_replace('.', '/', 'components.admin.' . $this->getView()) . '.blade.php'
		);

		if (!$this->files->isDirectory(dirname($path))) {
			$this->files->makeDirectory(dirname($path), 0777, true, true);
		}

		if ($this->files->exists($path) && !$this->option('force')) {
			$this->components->error('View already exists.');

			return;
		}

		file_put_contents(
			$path,
			file_get_contents($this->getStub())
		);

		if ($onSuccess) {
			$onSuccess();
		}
	}

}