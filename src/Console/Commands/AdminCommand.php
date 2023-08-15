<?php

namespace jCube\Console\Commands;

use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use jCube\Models\Admin;

class AdminCommand extends Command
{

	protected $name = 'jcube:admin';
	protected $signature = 'jcube:admin {name?} {email?} {password?}  {--status=}';
	protected $description = 'ICreate or update admin user';

	public function handle()
	{
		try {
			$staff = new Admin();

			$staff->name =  $this->argument('name') ?? $this->ask('What is your name?', 'admin');
			$staff->username = $staff->name;
			$staff->password = Hash::make($this->argument('password') ?? $this->secret('What is the password?'));
			$staff->email = $this->argument('email') ?? $this->ask('What is your email?', 'admin@admin.com');
			$staff->email_verified_at = time();
			$staff->status = $this->option('status') ?: 0;

			$staff->save();

			$this->info('User created successfully.');

		} catch (Exception|QueryException $e) {
			$this->error($e->getMessage());
		}

	}


}