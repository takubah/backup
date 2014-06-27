<?php

/* Route Pattern */
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[A-Za-z0-9-_]+');
Route::pattern('username', '[A-Za-z0-9-_]+');
/* End Route Pattern */


/**
* API ROUTING
*/
	$apiUrl 	= Config::get('asmoyo::api.url');

	Route::group(array('prefix' => $apiUrl, 'before' => 'ApiFilter'), function() use($apiUrl)
	{
		// resource
		foreach (app('asmoyo.resources') as $value)
		{
			Route::pattern($value, '[0-9]+');
		}
		// end resource

		// ApiUser
		$u = str_replace('/', '.', $apiUrl).'.user.';
		Route::resource('user', 'Api_User');
		Route::get('user/{username}', array('as' => $u .'showUsername', 'uses' => 'Api_User@showUsername'));
		
		// ApiPage
		$p = str_replace('/', '.', $apiUrl).'.page.';
		Route::resource('page', 'Api_Page');
		Route::get('page/{slug}', array('as' => $p .'showSlug', 'uses' => 'Api_Page@showSlug'));
		
		// ApiMedia
		$m = str_replace('/', '.', $apiUrl).'.media.';
		Route::resource('media', 'Api_Media');
		Route::get('media/{slug}', array('as' => $m .'showSlug', 'uses' => 'Api_Media@showSlug'));
		
		// ApiCategory
		$c = str_replace('/', '.', $apiUrl).'.category.';
		Route::resource('category', 'Api_Category');
		Route::get('category/{slug}', array('as' => $c .'showSlug', 'uses' => 'Api_Category@showSlug'));

		Route::get('gallery', array('as' => $c .'gallery', 'uses' => 'Api_Category@gallery'));
		Route::get('gallery/{slug}', array('as' => $c .'galleryShow', 'uses' => 'Api_Category@galleryShow'));

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