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

		$this->call('FirstTableSeeder');
		$this->call('OptionTableSeeder');
		$this->call('MediaTableSeeder');
	}

}
