<?php

$adminUrl = Config::get('asmoyo::admin_url');

/* Route Pattern */
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[A-Za-z0-9-_]+');
/* End Route Pattern */

/**
* ADMIN ROUTING
*/

	// Authentication
	Route::group(array('prefix' => $adminUrl), function() use($adminUrl)
	{
		Route::get('login', array(
			'before'	=> 'Anonymous',
			'as' 		=> 'admin.auth.login',
			'uses' 		=> 'UserController@adminLogin'
		));
		Route::post('login', array(
			'before'	=> 'Anonymous',
			'as' 		=> 'admin.auth.login',
			'uses' 		=> 'UserController@postAdminLogin'
		));
		Route::get('logout', array(
			'as' 		=> 'admin.auth.logout',
			'uses' 		=> 'UserController@adminLogout'
		));
	});
	// End Authentication 

	Route::group(array('prefix' => $adminUrl, 'before' => 'AdminFilter'), function() use($adminUrl)
	{
		// user
		Route::resource('user', 'UserController');
	});

/**
* ADMIN ROUTING
*/