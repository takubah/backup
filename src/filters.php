<?php

// http cache using Etag header
Route::filter('etag.get', 'Antoniputra\Asmoyo\Utilities\Cache\EtagFilter@get');
Route::filter('etag.set', 'Antoniputra\Asmoyo\Utilities\Cache\EtagFilter@set');

// caching response
Route::filter('cache.get', 'Antoniputra\Asmoyo\Utilities\Cache\CacheFilter@get');
Route::filter('cache.set', 'Antoniputra\Asmoyo\Utilities\Cache\CacheFilter@set');

/**
* just anonymous(not logged in) only has allowed access
*/
Route::filter('Anonymous', function($route, $request, $value=null)
{
	$value = $value ?: 'admin.home.dashboard';

	if( Auth::check() )
	{
		return Redirect::route($value);
	}
});

/**
* Check the user has logged in
*/
Route::filter('User', function($route, $request, $value=null)
{
	$value = $value ?: 'admin.auth.login';

	if( !Auth::check() )
	{
		return Redirect::route($value);
	}
});

/**
* check for admin area
*/
Route::filter('AdminFilter', function()
{
	$user = app('Antoniputra\Asmoyo\Users\UserInterface')->auth();

	if( !$user ) return App::abort(403, 'you don\'t have permission bro');

	if( !isset($user['permissions']['superuser']) )
	{
		return App::abort(403, 'you don\'t have permission bro');
	}
});

/**
* check for permission
*/
Route::filter('Permission', function($route, $request, $value)
{
	try
	{
		$user = Asmoyo::auth();
		if( !$user ) throw new Exception("Error Processing Request");

		if( !isset($user->getPermissions[$value]) )
		{
			throw new Exception("Error Processing Request");
		}
	}
	catch (Exception $e)
	{
		return Redirect::route('admin.auth.login');
	}
});


/**
* Handle error 404
*/
\App::missing(function($exception)
{
	// return \Response::view('errorView', array(), 404);
	return \Response::json('not found', 404);
});