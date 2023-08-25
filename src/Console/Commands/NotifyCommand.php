<?php

namespace jCube\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use jCube\Models\NotificationTemplate;

class NotifyCommand extends Command
{
	protected $name = 'jcube:notify';

	protected $signature = 'jcube:notify {action?}';

	protected $description = 'Add new notification template';

	public function handle()
	{
		try {
			$action = $this->argument('action') ?: $this->ask('What action?');

			$file = dirname(__DIR__, 3) . '/NotificationTemplates/' . $action . '.php';
			if (!file_exists($file)) {
				$this->error('Template not found');
			} else {
				$tpl = include_once $file;
				if (!NotificationTemplate::where('act', $tpl['act'])->first()) {
					$notify = new NotificationTemplate();
					$notify->fill($tpl);
					$notify->saveOrFail();
					$this->info('Template saved');
				} else {
					$this->error('Template already exists');
				}
			}

		} catch (Exception|QueryException $e) {
			$this->error($e->getMessage());
		}

	}
}
