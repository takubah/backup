<?php

/* Route Pattern */
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[A-Za-z0-9-_]+');
/* End Route Pattern */


/**
* API ROUTING
*/
	$apiUrl 	= Config::get('asmoyo::api.url');

	Route::group(array('prefix' => $apiUrl, 'before' => 'ApiFilter'), function() use($apiUrl)
	{
		// ApiUser
		Route::resource('user', 'Api_User');
		
		// ApiMedia
		Route::resource('media', 'Api_Media');
		
		// ApiCategory
		Route::resource('category', 'Api_Category');

	});
/**
* End API ROUTING
*/


/**
* ADMIN ROUTING
*/
	$adminUrl 	= Config::get('asmoyo::admin.url');

	// Authentication
	Route::group(array('prefix' => $adminUrl), function() use($adminUrl)
	{
		Route::get('login', array(
			'before'	=> 'Anonymous',
			'as' 		=> 'admin.auth.login',
			'uses' 		=> 'Admin_UserController@adminLogin'
		));
		Route::post('login', array(
			'before'	=> 'Anonymous',
			'as' 		=> 'admin.auth.login',
			'uses' 		=> 'Admin_UserController@postAdminLogin'
		));
		Route::get('logout', array(
			'as' 		=> 'admin.auth.logout',
			'uses' 		=> 'Admin_UserController@adminLogout'
		));
	});
	// End Authentication 

	Route::group(array('prefix' => $adminUrl, 'before' => 'AdminFilter'), function() use($adminUrl)
	{
		// user
		Route::resource('user', 'Admin_UserController');
	});

/**
* ADMIN ROUTING
*/