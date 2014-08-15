<?php

// Global Variable for view
View::composer(array('*'), function($view)
{
	// add web option to view
	$web = app('asmoyo.web');
	$view->with('web', $web);

	// variable for active page indicator
	$segment = Request::segment(2);
	$view->with('activePage', $segment);

	// variable for logged in user data
	$auth 	= App::make('Antoniputra\Asmoyo\Users\UserInterface')->auth();
	$view->with('auth', $auth);

	// variable for paginated number row
	$page 	 = ( is_numeric(Input::get('page', 1)) ) ? Input::get('page', 1) : 1 ;
	$view->with('itemNumber', ($page - 1) * Input::get('limit', $web['web_itemPerPage']) + 1);

	// variable global for theme path
	$theme = ( Request::segment(1) == 'admin' ) 
			? 'asmoyo::admin.twoCollumn'
			: 'asmoyo-theme.'. $web['web_publicTemplate']['name'] .'.';
	$view->with('theme',  $theme);
});

// set variable depends for header 
View::composer(array('asmoyoTheme.*.partials.header'), function($view)
{
	$navbar = app('Antoniputra\Asmoyo\Pages\PageInterface')->getAsMenu();
	$view->with('navbar', $navbar);
});

// set variable depends for banner 
View::composer(array('asmoyoTheme.*.partials.banner'), function($view)
{
	$banner = app('Antoniputra\Asmoyo\Pages\PageInterface')->getAsMenu();
	$view->with('banner', $banner);
});