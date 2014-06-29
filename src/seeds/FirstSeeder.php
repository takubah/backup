<?php

class FirstSeeder extends Seeder {

	public function run()
	{
		// Medias Seeder
		DB::table('medias')->truncate();

		$medias 	= array(
			array(
			    'gallery_id'	=> 1,
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
				'status'		=> 'publish',
			),
			array(
				'media_id'		=> 1,
				'parent_id'		=> 0,
				'title'			=> 'My First Category',
				'slug'			=> 'my-first-category',
				'description'	=> 'bla bla bla description',
				'status'		=> 'publish',
			),
		);

		DB::table('categories')->insert($categories);
		// End Categories Seeder

		// Galleries Seeder
		DB::table('galleries')->truncate();

		$galleries 	= array(
			array(
				'media_id'		=> 1,
				'title'			=> 'Album Default',
				'slug'			=> 'album-default',
				'description'	=> 'Uncategorized Item',
				'status'		=> 'publish',
			),
			array(
				'media_id'		=> 1,
				'title'			=> 'My First Album',
				'slug'			=> 'my-first-album',
				'description'	=> 'bla bla bla description',
				'status'		=> 'publish',
			),
		);

		DB::table('galleries')->insert($galleries);
		// End Galleries Seeder
	}

}