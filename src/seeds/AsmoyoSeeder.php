<?php

class AsmoyoSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('FirstSeeder');
		$this->call('OptionTableSeeder');
		$this->call('MediaTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('PostTableSeeder');
	}

}
