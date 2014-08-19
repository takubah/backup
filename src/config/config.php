<?php

return array(

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
	* Uploads path settings
	*/
	'uploads'		=> array(

		/**
		* where base upload path should be stored
		*/
		'path'			=> public_path('packages/antoniputra/asmoyo/uploads/'),

		/**
		* where image upload path should be stored
		*/
		'path_image'	=> public_path('packages/antoniputra/asmoyo/uploads/images/'),

		/**
		* where audio upload path should be stored
		*/
		'path_audio'	=> public_path('packages/antoniputra/asmoyo/uploads/audio/'),

		/**
		* where video upload path should be stored
		*/
		'path_video'	=> public_path('packages/antoniputra/asmoyo/uploads/video/'),

	),

	/**
	* Pseudo setting
	*/
	'pseudo'	=> array(

		/**
		* Register All your pseudo object here
		* *
		* object_name => path to object class should extend of pseudo class
		*/
		'object'	=> array(
			'post'		=> 'Antoniputra\Asmoyo\Utilities\Pseudo\View\PostPseudo',
			'media'		=> 'Antoniputra\Asmoyo\Utilities\Pseudo\View\MediaPseudo',
			'category'	=> 'Antoniputra\Asmoyo\Utilities\Pseudo\View\CategoryPseudo',
			'comment'	=> 'Antoniputra\Asmoyo\Utilities\Pseudo\View\CommentPseudo',
			// ...
		),

		'attribute'	=> array(
			'type'		=> array('list', 'grid', 'media-object', 'detail'),
			'limit'		=> 3,
			'sortir'	=> array('title-ascending', 'title-descending', 'new'),
			'status'	=> array('published', 'privated')
		),

	),
);