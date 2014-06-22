<?php

return array(

	/**
	* Set Profiler (Debug Bar)
	*/
	'profiler'		=> Config::get('app.debug'),

	/**
	* Set Database
	*/
	'database'		=> 'mysql',

	/**
	* Set Auth Model
	*/
	'auth_model'	=> 'Antoniputra\Asmoyo\Users\User',

	/**
	* Admin Settings
	*/
	'admin'		=> array(

		/**
		* Admin Url
		*/
		'url'	=>	'admin'
	),

	/**
	* Api Settings
	*/
	'api'			=> array(

		/**
		* Enabled API boolean (true/false)
		*/
		'status'	=> true,

		/**
		* Api Url
		*/
		'url'		=> 'api/v1'
	),
);