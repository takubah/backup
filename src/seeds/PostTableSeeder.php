<?php

class PostTableSeeder extends Seeder {

	public function run()
	{
		DB::table('posts')->truncate();

		$posts 	= array(
			array(
			    'groupable_id' 		=> 1,
			    'groupable_type' 	=> 'Antoniputra\Asmoyo\Categories\Category',
			    'media_id' 			=> 1,
			    'user_id' 			=> 1,
			    'type'            	=> 'article',
			    'title' 			=> 'My First Article',
			    'slug' 				=> \Str::slug('my-first-article'),
			    'description' 		=> 'hello world',
			    'body'				=> nl2br('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
			    'status'			=> 'published',
			    'meta_title'		=> 'plensip example article',
			    'meta_keyword'		=> 'plensip example article',
			    'meta_description'	=> 'plensip example article',
			),

			array(
			    'groupable_id' 		=> 1,
			    'groupable_type' 	=> 'Antoniputra\Asmoyo\Categories\Category',
			    'media_id' 			=> 1,
			    'user_id' 			=> 1,
			    'type'            	=> 'audio',
			    'title' 			=> 'My First Audio',
			    'slug' 				=> \Str::slug('my-first-audio'),
			    'description' 		=> 'hello world',
			    'body'				=> nl2br('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.'),
			    'status'			=> 'published',
			    'meta_title'		=> 'plensip example audio',
			    'meta_keyword'		=> 'plensip example audio',
			    'meta_description'	=> 'plensip example audio',
			),

			array(
			    'groupable_id' 		=> 1,
			    'groupable_type' 	=> 'Antoniputra\Asmoyo\Categories\Category',
			    'media_id' 			=> 1,
			    'user_id' 			=> 1,
			    'type'            	=> 'audio',
			    'title' 			=> 'My Second Audio',
			    'slug' 				=> \Str::slug('my-first-audio'),
			    'description' 		=> 'hello world',
			    'body'				=> nl2br('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.consectetur adipisicing elit, sed do eiusmod.'),
			    'status'			=> 'privated',
			    'meta_title'		=> 'plensip example audio',
			    'meta_keyword'		=> 'plensip example audio',
			    'meta_description'	=> 'plensip example audio',
			),

		);

		DB::table('posts')->insert($posts);
	}

}