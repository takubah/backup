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
		// resource pattern
		foreach (app('asmoyo.resources') as $value)
		{
			Route::pattern($value, '[0-9]+');
		}
		// end resource pattern

		// Api_User
		$u = str_replace('/', '.', $apiUrl).'.user.';
		Route::resource('user', 'Api_User');
		Route::get('user/{username}', array('as' => $u .'showUsername', 'uses' => 'Api_User@showUsername'));
		
		// Api_Page
		$p = str_replace('/', '.', $apiUrl).'.page.';
		Route::resource('page', 'Api_Page');
		Route::get('page/{slug}', array('as' => $p .'showSlug', 'uses' => 'Api_Page@showSlug'));
		
		// Api_Media
		$m = str_replace('/', '.', $apiUrl).'.media.';
		Route::resource('media', 'Api_Media');
		Route::get('media/{slug}', array('as' => $m .'showSlug', 'uses' => 'Api_Media@showSlug'));
		
		// Api_Category
		$c = str_replace('/', '.', $apiUrl).'.category.';
		Route::resource('category', 'Api_Category');
		Route::get('category/{slug}', array('as' => $c .'showSlug', 'uses' => 'Api_Category@showSlug'));

		// Api_Gallery
		$g = str_replace('/', '.', $apiUrl).'.gallery.';
		Route::resource('gallery', 'Api_Gallery');
		Route::get('gallery/{slug}', array('as' => $g .'showSlug', 'uses' => 'Api_Gallery@showSlug'));

		// Api_Post
		$post = str_replace('/', '.', $apiUrl).'.post.';
		Route::resource('post', 'Api_Post');
		Route::get('post/{slug}', array('as' => $post .'showSlug', 'uses' => 'Api_Post@showSlug'));

		// Api_Widget
		$widget = str_replace('/', '.', $apiUrl).'.widget.';
		Route::resource('widget', 'Api_Widget');
		Route::get('widget/group', array('as' => $widget .'group', 'uses' => 'Api_Widget@group'));
		Route::get('widget/group/{slug}', array('as' => $widget .'groupShow', 'uses' => 'Api_Widget@groupShow'));
		Route::get('widget/{slug}', array('as' => $widget .'showSlug', 'uses' => 'Api_Widget@showSlug'));

	});
/**
* End API ROUTING
*/


/**
* ASSET ROUTING
*/
	$assetsUrl 	= Config::get('asmoyo::assets.url');

	Route::group(array('prefix' => $assetsUrl), function() use($assetsUrl)
	{
		Route::get('admin/{file}', array(
			'as' 		=> 'assets.admin.get',
			'uses' 		=> 'AsmoyoController@assetsAdmin'
		))->where('file', '(.*)')
		->before('cache.get')->after('cache.set');
	});

/**
* END ASSET ROUTING
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