<?php

class WidgetTableSeeder extends Seeder {

	public function run()
	{
		$widgets 	= array(
			array(
				'objectable_id' 	=> null,
				'objectable_type' 	=> null,
			    'title' 			=> 'bootstrap-banner',
			    'description' 		=> 'bootstrap banner for your banner',
			    'content'	 		=> '',
			    'view_path'			=> 'bootstrap-banner',
			    'is_hasMany'  		=> 1,
			),

		);

		DB::table('widgets')->insert($widgets);
	}

}