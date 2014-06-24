<?php

class FirstSeeder extends Seeder {

	public function run()
	{
		// Medias Seeder
		DB::table('medias')->truncate();

		$medias 	= array(
			array(
			    'category_id'	=> 0,
			    'type' 			=> 'internal',
			    'file'			=> 'default.jpg',
			    'mime_type'		=> 'image/jpeg',
			    'size'			=> 100,
			    'title' 		=> 'my default image',
			    'description' 	=> 'your default image for missed image',
			),
		);

		DB::table('medias')->insert($medias);
		// End Medias Seeder

		// Categories Seeder
		DB::table('categories')->truncate();

		$categories 	= array(
			array(
				'media_id'		=> 1,
				'parent_id'		=> null,
				'title'			=> 'Uncategorized',
				'url'			=> 'uncategorized',
				'description'	=> 'Uncategorized Item',
				'type'			=> 'category',
				'status'		=> 'publish',
			),
			array(
				'media_id'		=> 1,
				'parent_id'		=> null,
				'title'			=> 'My Album',
				'url'			=> 'my-first-gallery',
				'description'	=> 'My Default Album',
				'type'			=> 'gallery',
				'status'		=> 'publish',
			),
		);

		DB::table('categories')->insert($categories);
		// End Categories Seeder

		// Pages Seeder
		DB::table('pages')->truncate();

		$pages 	= array(
			array(
				'parent_id' 		=> null,
				'status' 			=> 'published',
				'title' 			=> 'Home',
				'url' 				=> '/',
				'content'			=> json_encode(array(
					'{<asmoyo:post slug:>}'
				)),
				'side_left'			=> json_encode(array()),
				'side_right'		=> json_encode(array()),
				'footer'			=> json_encode(array()),
				'meta_title'		=> null,
				'meta_keyword' 		=> null,
				'meta_description'	=> null,
			),
		);

		DB::table('pages')->insert($pages);
		// End Pages Seeder
	}

}