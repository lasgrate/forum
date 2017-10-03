<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateSettings extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'setting:create {name} {value}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create settings';

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
			'name' => 'required|string|unique:settings|max:256',
			'value' => 'required|string',
		]);

		if (!$validator->fails()) {

			DB::table('settings')->insert([
				'name' => $this->argument('name'),
				'value' => $this->argument('value'),
			]);

			$this->info('Setting had successfully created');

		} else {
			$errors = $validator->errors();

			foreach ($errors->all() as $message) {
				$this->error($message);
			}
		}

		return;
	}
}
