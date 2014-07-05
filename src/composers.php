<?php

// Global Variable for view
View::composer(array('*'), function($view)
{
	$segment = Request::segment(2);
	$view->with( 'activePage', $segment );

	$auth 	= App::make('Antoniputra\Asmoyo\Users\UserInterface')->auth();
	$view->with('auth', $auth);
});