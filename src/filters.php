<?php

// http cache header
Route::filter('cached.request', 'Antoniputra\Asmoyo\Utilities\Cache\Etags\RequestFilter@before');
Route::filter('cached.response', 'Antoniputra\Asmoyo\Utilities\Cache\Etags\RequestFilter@after');

/**
* just anonymous(not logged in) only has allowed access
*/
Route::filter('Anonymous', function($route, $request, $value=null)
{
	$value = $value ?: 'admin.home.index';

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
	$user = Asmoyo::auth();

	if( !$user ) return App::abort(403, 'you don\'t have permission bro');

	if( !isset($user->getPermissions['superuser']) )
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