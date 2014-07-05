<?php

// Global Variable for view
View::composer(array('*'), function($view)
{
	$web = app('asmoyo.web');

	// variable for active page indicator
	$segment = Request::segment(2);
	$view->with( 'activePage', $segment );

	// variable for logged in user data
	$auth 	= App::make('Antoniputra\Asmoyo\Users\UserInterface')->auth();
	$view->with('auth', $auth);

	// variable for paginated number row
	$page 	 = ( is_numeric(Input::get('page', 1)) ) ? Input::get('page', 1) : 1 ;
	$view->with( 'itemNumber', ($page - 1) * Input::get('limit', $web['web_itemPerPage']) + 1 );

	// variable global for theme path
	$theme = ( Request::segment(1) == 'admin' ) 
			? 'asmoyo::admin.twoCollumn'
			: 'asmoyo-theme.'. $web['web_publicTemplate'] .'.';

	$view->with( 'theme',  $theme);
});