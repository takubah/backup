<?php

class MediaTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('media')->truncate();

		$media 	= array(
			array(
				'category_id'	=> 1,
				'title'			=> '',
			),

		);

		DB::table('media')->insert($media);
	}

}