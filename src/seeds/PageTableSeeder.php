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
				'is_locked'			=> 1,
				'title' 			=> 'Home',
				'slug' 				=> 'home',
				'content'			=> '',
				'content_structure'	=> json_encode(array(
					array(
						'title'	 	=> 'Page Content',
						'widget'	=> null,
						'content'	=> 'page_content_output',
					),
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
				'order'				=> 2,
				'is_locked'			=> 1,
				'title' 			=> 'About',
				'slug' 				=> 'about',
				'content'			=> '',
				'content_structure'	=> json_encode(array(
					array(
						'title'	 	=> 'Page Content',
						'widget'	=> null,
						'content'	=> 'page_content_output',
					),
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
				'status' 			=> 'privated',
				'type'	 			=> 'category',
				'structure'			=> 'twoCollumn',
				'order'				=> 3,
				'is_locked'			=> 1,
				'title' 			=> 'Kategori',
				'slug' 				=> 'kategori',
				'content'			=> '',
				'content_structure'	=> json_encode(array(
					array(
						'title'	 	=> 'Page Content',
						'widget'	=> null,
						'content'	=> 'page_content_output',
					),
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
				'status' 			=> 'privated',
				'type'	 			=> 'post',
				'structure'			=> 'twoCollumn',
				'order'				=> 4,
				'is_locked'			=> 1,
				'title' 			=> 'Posting',
				'slug' 				=> 'posting',
				'content'			=> '',
				'content_structure'	=> json_encode(array(
					array(
						'title'	 	=> 'Page Content',
						'widget'	=> null,
						'content'	=> 'page_content_output',
					),
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