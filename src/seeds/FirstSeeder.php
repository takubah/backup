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
			    'slug'	 		=> \Str::slug('my default image'),
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
				'parent_id'		=> 0,
				'title'			=> 'Uncategorized',
				'slug'			=> 'uncategorized',
				'description'	=> 'Uncategorized Item',
				'type'			=> 'category',
				'status'		=> 'publish',
			),
			array(
				'media_id'		=> 1,
				'parent_id'		=> 0,
				'title'			=> 'My Album',
				'slug'			=> 'my-first-gallery',
				'description'	=> 'My Default Album',
				'type'			=> 'gallery',
				'status'		=> 'publish',
			),
		);

		DB::table('categories')->insert($categories);
		// End Categories Seeder
	}

}