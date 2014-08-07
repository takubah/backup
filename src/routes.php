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

	Route::get('uploads/{size}/{file?}', array(
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
		// Home
		Route::get('dashboard', array(
			'as'	=> 'admin.home.dashboard',
			'uses'	=> 'Admin_HomeController@dashboard',
		));
		// End Home
		
		// User
		Route::get('user/change-password', array(
			'as' 		=> 'admin.user.changePassword',
			'uses' 		=> 'Admin_UserController@changePassword'
		));
		Route::put('user/change-password', array(
			'as' 		=> 'admin.user.putChangePassword',
			'uses' 		=> 'Admin_UserController@putChangePassword'
		));
		Route::resource('user', 'Admin_UserController');
		// End User

		// Page
		Route::get('page/edit-order', array(
			'as' 		=> 'admin.page.editOrder',
			'uses' 		=> 'Admin_PageController@editOrder'
		));
		Route::put('page/edit-order-save', array(
			'as' 		=> 'admin.page.editOrderSave',
			'uses' 		=> 'Admin_PageController@editOrderSave'
		));
		Route::delete('page/forceDelete/{id}', array(
			'as' 		=> 'admin.page.forceDelete',
			'uses' 		=> 'Admin_PageController@forceDelete'
		));
		Route::resource('page', 'Admin_PageController');
		// End Page

		// Media
		Route::get('media/ajaxIndex', array(
			'as' 		=> 'admin.media.ajaxIndex',
			'uses' 		=> 'Admin_MediaController@ajaxIndex'
		));
		Route::get('media/getForFroala', array(
			'as' => 'admin.media.getForFroala',
			'uses' => 'Admin_MediaController@getForFroala'
		));
		Route::post('media/storeFroala', array(
			'as' => 'admin.media.storeFroala',
			'uses' => 'Admin_MediaController@storeFroala'
		));
		Route::resource('media', 'Admin_MediaController');
		// End Media

		// Gallery
		Route::resource('gallery', 'Admin_GalleryController');
		// End Gallery

		// Category
		Route::delete('category/forceDelete/{id}', array(
			'as' 		=> 'admin.category.forceDelete',
			'uses' 		=> 'Admin_CategoryController@forceDelete'
		));
		Route::resource('category', 'Admin_CategoryController');
		// End Category

		// Post
		Route::delete('post/forceDelete/{id}', array(
			'as' 		=> 'admin.post.forceDelete',
			'uses' 		=> 'Admin_PostController@forceDelete'
		));
		Route::resource('post', 'Admin_PostController');
		// End Post

		// Widget
		Route::get('widget', array(
			'as' 		=> 'admin.widget.index',
			'uses' 		=> 'Admin_WidgetController@index'
		));
		Route::get('widget/{slug}', array(
			'as' 		=> 'admin.widget.show',
			'uses' 		=> 'Admin_WidgetController@show'
		));
		Route::put('widget/{id}/enable', array(
			'as' 		=> 'admin.widget.enable',
			'uses' 		=> 'Admin_WidgetController@enable'
		));
		Route::put('widget/{id}/disable', array(
			'as' 		=> 'admin.widget.disable',
			'uses' 		=> 'Admin_WidgetController@disable'
		));

		// widget group
		Route::get('widget/{slug}/index', array(
			'as' 		=> 'admin.widget.group',
			'uses' 		=> 'Admin_WidgetController@group'
		));
		Route::get('widget/{slug}/create', array(
			'as' 		=> 'admin.widget.group.create',
			'uses' 		=> 'Admin_WidgetController@groupCreate'
		));
		Route::post('widget/{slug}/create', array(
			'as' 		=> 'admin.widget.group.store',
			'uses' 		=> 'Admin_WidgetController@groupStore'
		));
		Route::get('widget/{slug}/show/{any}', array(
			'as' 		=> 'admin.widget.group.showAjax',
			'uses' 		=> 'Admin_WidgetController@groupShowAjax'
		));
		Route::get('widget/{slug}/edit/{any}', array(
			'as' 		=> 'admin.widget.group.edit',
			'uses' 		=> 'Admin_WidgetController@groupEdit'
		));
		Route::put('widget/{slug}/edit/{any}', array(
			'as' 		=> 'admin.widget.group.update',
			'uses' 		=> 'Admin_WidgetController@groupUpdate'
		));
		Route::delete('widget/{slug}/destroy/{id}', array(
			'as' 		=> 'admin.widget.group.destroy',
			'uses' 		=> 'Admin_WidgetController@groupDestroy'
		));
		// End Widget

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
		Route::put('option/mediaSave', array(
			'as' 		=> 'admin.option.mediaSave',
			'uses' 		=> 'Admin_OptionController@mediaSave'
		));
		// End Option

		// Display
		Route::get('display', array(
			'as'	=> 'admin.display.index',
			'uses'	=> 'Admin_DisplayController@index'
		));
		Route::get('display/ajaxSidebar/{slug}', array(
			'as'	=> 'admin.display.ajaxSidebar',
			'uses'	=> 'Admin_DisplayController@ajaxSidebar'
		));
		Route::post('display/ajaxSidebarAdd/{slug}', array(
			'as'	=> 'admin.display.ajaxSidebarAdd',
			'uses'	=> 'Admin_DisplayController@ajaxSidebarAdd'
		));
		Route::post('display/update/{slug}', array(
			'as'	=> 'admin.display.ajaxSidebarUpdate',
			'uses'	=> 'Admin_DisplayController@ajaxSidebarUpdate'
		));
		Route::post('display/remove/{slug}', array(
			'as'	=> 'admin.display.ajaxSidebarRemove',
			'uses'	=> 'Admin_DisplayController@ajaxSidebarRemove'
		));
		// End Display
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
	// End Page

	
	// Category
	Route::get('/category', array(
		'as'	=> 'category.index',
		'uses'	=> 'Public_CategoryController@index',
	));

	Route::get('/category/{slug}', array(
		'as'	=> 'category.show',
		'uses'	=> 'Public_CategoryController@show',
	));
	// End Category

	// Post
	Route::resource('post', 'Public_PostController', array(
		'except' => array('create', 'store', 'edit', 'update', 'destroy')
	));

/**
* END PUBLIC ROUTING
*/