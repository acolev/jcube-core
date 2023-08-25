<?php

namespace jCube\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use jCube\Models\NotificationTemplate;

class NotifyCommand extends Command
{
	protected $name = 'jcube:notify';

	protected $signature = 'jcube:notify {action?} {--all}';

	protected $description = 'Add new notification template';

	public function handle()
	{
		try {
			$folders = [
				dirname(__DIR__, 3) . '/stubs/notify/',
				'stubs/notify/',
			];
			if ($this->option('all')) {
				foreach ($folders as $folder) {
					foreach (glob($folder . '*') as $file) {
						if (file_exists($file)) {
							$tpl = include_once $file;
							if (!$this->save($tpl)) {
								$this->warn('Skip: ' . $tpl['act']);
							}
						}
					}
				}
			} else {
				$file = null;
				$action = $this->argument('action') ?: $this->ask('What action?');
				foreach ($folders as $folder) {
					$__file = $folder . $action . '.php';
					if (file_exists($__file)) $file = $__file;
				}

				if (!file_exists($file)) {
					$this->error('Template not found');
				} else {
					$tpl = include_once $file;
					if (!$this->save($tpl)) {
						$this->warn('Template already exists');
					}
				}
			}


		} catch (Exception|QueryException $e) {
			$this->error($e->getMessage());
		}

	}

	protected function save($tpl)
	{
		if (!NotificationTemplate::where('act', $tpl['act'])->first()) {
			$notify = new NotificationTemplate();
			$notify->fill($tpl);
			$notify->saveOrFail();
			$this->info('insert: ' . $tpl['act']);
			return 1;
		}
		return 0;
	}
}
