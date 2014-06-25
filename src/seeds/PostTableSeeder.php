<?php

class PostTableSeeder extends Seeder {

	public function run()
	{
		$posts 	= array(
			array(
			    'groupable_id' 		=> 1,
			    'groupable_type' 	=> 'category',
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

		);

		DB::table('posts')->insert($posts);
	}

}