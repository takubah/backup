<?php

class PageTableSeeder extends Seeder {

	public function run()
	{
		DB::table('pages')->truncate();

		$pages 	= array(
			array(
				'parent_id' 		=> 0,
				'status' 			=> 'published',
				'type'	 			=> 'standard',
				'structure'			=> 'oneCollumn',
				'order'				=> 0,
				'title' 			=> 'Home',
				'slug' 				=> 'home',
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
			array(
				'parent_id' 		=> 0,
				'status' 			=> 'published',
				'type'	 			=> 'standard',
				'structure'			=> 'twoCollumn',
				'order'				=> 0,
				'title' 			=> 'About',
				'slug' 				=> 'about',
				'content'			=> json_encode(array(
					'ini adalah halaman about'
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
	}

}