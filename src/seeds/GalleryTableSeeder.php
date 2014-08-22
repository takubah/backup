<?php

class GalleryTableSeeder extends Seeder {

	public function run()
	{
		// Galleries Seeder
		DB::table('galleries')->truncate();

		$galleries 	= array(
			array(
				'media_id'		=> 1,
				'title'			=> 'Album Default',
				'slug'			=> 'album-default',
				'description'	=> 'Uncategorized Item',
				'status'		=> 'published',
			),
			array(
				'media_id'		=> 1,
				'title'			=> 'My First Album',
				'slug'			=> 'my-first-album',
				'description'	=> 'bla bla bla description',
				'status'		=> 'published',
			),
		);

		DB::table('galleries')->insert($galleries);
		// End Galleries Seeder



		// Galleries_Medias Seeder
		DB::table('galleries_medias')->truncate();
		
		$galleries_medias 	= array(
			array(
				'gallery_id'	=> 1,
				'media_id'		=> 1,
			),
			array(
				'gallery_id'	=> 1,
				'media_id'		=> 2,
			),
		);

		DB::table('galleries_medias')->insert($galleries_medias);
		// End Galleries_Medias Seeder
	}

}