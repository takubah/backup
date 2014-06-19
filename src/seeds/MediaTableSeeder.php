<?php

class MediaTableSeeder extends Seeder {

	public function run()
	{
		$medias 	= array(
			array(
			    'category_id'	=> 2,
			    'type' 			=> 'internal',
			    'file'			=> 'example.jpg',
			    'mime_type'		=> 'image/jpeg',
			    'size'			=> 200,
			    'title' 		=> 'example image',
			    'description' 	=> 'example image for missed image',
			),

		);

		DB::table('medias')->insert($medias);
	}

}