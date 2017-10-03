<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreateUsers extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:create {role=admin} {--email=admin@gmail.com} {--password=111111} {--name=admin}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create users with different roles';

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{

		$validator = Validator::make(array_merge($this->arguments(), $this->options()), [
			'email' => 'required|email|unique:users',
			'role' => [
				'required',
				Rule::in(['admin', 'user', 'partner']),
			],
			'password' => 'required|max:60|min:6',
			'name' => 'required|max:32',
		]);


		if (!$validator->fails()) {
			DB::table('users')->insert([
				'email' => $this->option('email'),
				'password' => bcrypt($this->option('password')),
				'role' => $this->argument('role'),
				'name' => $this->option('name')
			]);

			$this->info('User had successfully created');
		} else {
			$errors = $validator->errors();

			foreach ($errors->all() as $message) {
				$this->error($message);
			}
		}

		return;
	}
}
