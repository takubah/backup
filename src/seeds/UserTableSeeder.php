<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();

		$users 	= array(
			array(
				'email'       	=> 'admin@admin.com',
				'username'     	=> 'administrator',
	            'password'    	=> Hash::make('superadmin'),
	            'media_id'		=> 1,
	            'fullname'  	=> 'Administrator',
	            'activated'   	=> 1,
	            'permissions'	=> json_encode(array('superuser' => 1)),
	            'birthday'		=> \Carbon\Carbon::now(),
	            'city'			=> 'Surabaya',
	            'address'		=> 'Simo Gunung Barat Tol 1 / 59',
	            'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
			array(
				'email'       	=> 'akiddcode@gmail.com',
				'username'     	=> 'robertwijaya',
	            'password'    	=> Hash::make('antoni123'),
	            'media_id'		=> 2,
	            'fullname'  	=> 'Antoni Putra',
	            'activated'   	=> 1,
	            'permissions'	=> null,
	            'birthday'		=> \Carbon\Carbon::now(),
	            'city'			=> 'Surabaya',
	            'address'		=> 'Simo Gunung Barat Tol 1 / 59',
	            'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),

		);

		DB::table('users')->insert($users);
	}

}