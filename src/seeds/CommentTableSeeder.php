<?php

class CommentTableSeeder extends Seeder {

	public function run()
	{
		// Medias Seeder
		DB::table('comments')->truncate();

		$comments 	= array(
			array(
				'objectable_id'		=> 1,
				'objectable_type'	=> 'Antoniputra\Asmoyo\Posts\Post',
				'user_id'			=> 1,
				'type'				=> 'object',
				'title'				=> 'Wow Keren',
				'content'			=> 'Keren gan, lanjutkan sundul2',
				'status'			=> 'published',
				'anonymous_name'	=> '',
				'anonymous_email'	=> '',
				'anonymous_url'		=> '',
				'anonymous_agent'	=> '',
			),
			array(
				'objectable_id'		=> '',
				'objectable_type'	=> '',
				'user_id'			=> '',
				'type'				=> 'message',
				'title'				=> 'Saya minat memesan MC pak',
				'content'			=> 'Saya ingin bertemu dengan bapak, untuk bicara lebih lanjut.',
				'status'			=> 'privated',
				'anonymous_name'	=> 'Lorem',
				'anonymous_email'	=> 'lorem@gmail.com',
				'anonymous_url'		=> 'http://lorem.com',
				'anonymous_agent'	=> json_encode(array()),
			),
		);

		DB::table('comments')->insert($comments);
		// End Medias Seeder
	}

}