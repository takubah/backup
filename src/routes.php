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
			Route::pattern($value, '[A-Za-z0-9-_]+');
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
Route::group(array('before' => 'etag.get', 'after' => 'etag.set'), function()
{
	Route::get('assets/{theme}/{file}', array(
		'as'	=> 'getAssets',
		'uses'	=> 'AsmoyoController@getAssets',
	))->where('theme', '[A-Za-z0-9-_]+')->where('file', '(.*)');

	Route::get('uploads/{size}/{file}', array(
		'as'	=> 'getMedia',
		'uses'	=> 'AsmoyoController@getMedia',
	))->where('file', '(.*)');
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
			'as' 		=> 'admin.login',
			'uses' 		=> 'Admin_UserController@adminLogin'
		));
		Route::post('login', array(
			'before'	=> 'Anonymous',
			'as' 		=> 'admin.login',
			'uses' 		=> 'Admin_UserController@postAdminLogin'
		));
		Route::get('logout', array(
			'as' 		=> 'admin.logout',
			'uses' 		=> 'Admin_UserController@adminLogout'
		));
	});
	// End Authentication 

	Route::group(array('prefix' => $adminUrl, 'before' => 'AdminFilter'), function() use($adminUrl)
	{
		// dashboard
		Route::get('dashboard', array(
			'as'	=> 'admin.home.dashboard',
			'uses'	=> 'Admin_HomeController@dashboard',
		));
		
		// User
		Route::resource('user', 'Admin_UserController');

		// Page
		Route::get('page/edit-order', array(
			'as' 		=> 'admin.page.editOrder',
			'uses' 		=> 'Admin_PageController@editOrder'
		));
		Route::resource('page', 'Admin_PageController');

		// Media
		Route::get('media/ajaxIndex', array(
			'as' 		=> 'admin.media.ajaxIndex',
			'uses' 		=> 'Admin_MediaController@ajaxIndex'
		));
		Route::post('media/storeFroala', array('as' => 'admin.media.storeFroala', 'uses' => 'Admin_MediaController@storeFroala'));
		Route::resource('media', 'Admin_MediaController');

		// Category
		Route::resource('category', 'Admin_CategoryController');

		// Post
		Route::resource('post', 'Admin_PostController');

		// Widget
		Route::resource('widget', 'Admin_WidgetController');

		// Option
		Route::get('option', array(
			'as' 		=> 'admin.option.index',
			'uses' 		=> 'Admin_OptionController@index'
		));
		Route::get('option/web', array(
			'as' 		=> 'admin.option.web',
			'uses' 		=> 'Admin_OptionController@web'
		));
		Route::put('option/webSave', array(
			'as' 		=> 'admin.option.webSave',
			'uses' 		=> 'Admin_OptionController@webSave'
		));
		Route::get('option/media', array(
			'as' 		=> 'admin.option.media',
			'uses' 		=> 'Admin_OptionController@media'
		));
	});

/**
* END ADMIN ROUTING
*/

/**
* PUBLIC ROUTING
*/
	
	Route::get('/', array(
		'as'	=> 'home.index',
		'uses'	=> 'Public_HomeController@index',
	));

	// Page
	Route::get('/{slug}', array(
		'as'	=> 'page.show',
		'uses'	=> 'Public_PageController@show',
	));

	// Post
	Route::resource('post', 'Public_PostController', array(
		'except' => array('create', 'store', 'edit', 'update', 'destroy')
	));

/**
* END PUBLIC ROUTING
*/