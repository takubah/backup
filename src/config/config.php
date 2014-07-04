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
	* Cache Settings
	*/
	'cache'			=> array(

		/**
		* Base Cache Name
		*/
		'base_name'	=> 'plensip.com',

		/**
		* Cache Time
		* @see : forever or number in minutes
		*/
		'time'	=> 'forever',
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

	/**
	* Assets Settings
	*/
	'assets'			=> array(

		/**
		* Using Cdn ?
		*/
		'cdn'		=> '',
	),
);