<?php

class MediaTableSeeder extends Seeder {

	public function run()
	{
		$medias 	= array(
			array(
			    'gallery_id'	=> 2,
			    'type' 			=> 'internal',
			    'file'			=> 'example.jpg',
			    'mime_type'		=> 'image/jpeg',
			    'size'			=> 200,
			    'status'		=> 'published',
			    'title' 		=> 'example image',
			    'slug'	 		=> \Str::slug('example image'),
			    'description' 	=> 'example image for missed image',
			),
			array(
			    'gallery_id'	=> 2,
			    'type' 			=> 'internal',
			    'file'			=> 'logo.png',
			    'mime_type'		=> 'image/jpeg',
			    'size'			=> 200,
			    'status'		=> 'published',
			    'title' 		=> 'logo image',
			    'slug'	 		=> \Str::slug('logo image'),
			    'description' 	=> 'logo image for missed image',
			),
		);

		DB::table('medias')->insert($medias);
	}

}