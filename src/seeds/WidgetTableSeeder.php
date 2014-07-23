<?php

class WidgetTableSeeder extends Seeder {

	public function run()
	{
		/* Widgets */
		DB::table('widgets')->truncate();

		$widgets 	= array(
			array(
			    'title' 		=> 'Asmoyo Bootstrap Banner',
			    'slug'	 		=> 'asmoyo-bootstrap-banner',
			    'description' 	=> 'bootstrap banner for banner',
			    'has_group'  	=> 1,
			    'content'	 	=> '',
			    'attribute'		=> json_encode(array(
			    	'field' => array(
		    			'title'		=> 'text',
		    			'link'		=> 'text',
		    			'description' => 'textarea',
		    			'file'		=> 'media',
	    			),
			    	'validation' => array(
			    		'title' 	=> 'required',
			    		'link'		=> 'url',
			    		'description' => '',
			    		'file'		=> 'required|url'
		    		),
		    	)),
			    'status'	  	=> 'enabled',
			),

			array(
			    'title' 		=> 'Asmoyo Daftars',
			    'slug'	 		=> 'asmoyo-daftars',
			    'description' 	=> 'make list for your web info',
			    'has_group'  	=> 1,
			    'content'	 	=> '',
			    'attribute'		=> json_encode(array(
			    	'field' => array(
		    			'title'		=> 'text',
		    			'link'		=> 'text',
		    			'icon'		=> 'text',
		    			'description' => 'textarea',
	    			),
			    	'validation' => array(
			    		'title' 	=> 'required',
			    		'link'		=> 'url',
			    		'icon'		=> '',
			    		'description' => '',
		    		),
		    	)),
			    'status'	  	=> 'enabled',
			),
		);

		DB::table('widgets')->insert($widgets);
		/* End Widgets */

		/* Widgets_Groups */
		DB::table('widgets_groups')->truncate();

		$widgets_groups 	= array(
			// banner widget
			array(
				'widget_id' 		=> 1,
				'type'		 		=> '',
				'title' 			=> 'Banner Utama',
				'slug'	 			=> 'banner-utama',
				'description' 		=> 'Banner utama pada homepage',
				'content'			=> json_encode(array(
					array(
			    		'title'			=> 'Banner ke 1',
			    		'link'			=> 'http://google.co.id',
			    		'description' 	=> 'ini adalah banner ke 1',
			    		'file'			=> 'http://asmoyo.dev/uploads/medium/example.jpg'
		    		),
		    		array(
		    			'title'			=> 'Banner ke 2',
			    		'link'			=> 'http://facebook.com',
			    		'description' 	=> 'ini adalah banner ke 2',
			    		'file'			=> 'http://asmoyo.dev/uploads/medium/example.jpg'
	    			),
		    	)),
			),

			// daftars widget vertical
			array(
				'widget_id' 		=> 2,
				'type'		 		=> 'vertical',
				'title' 			=> 'Layanan Kami',
				'slug'	 			=> 'layanan-kami',
				'description' 		=> 'Daftar Layanan Kami',
				'content'			=> json_encode(array(
					array(
			    		'title'			=> 'Dekorasi Balon',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> '',
		    		),
		    		array(
		    			'title'			=> 'MC Badut (Ulang Tahun)',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> '',
	    			),
	    			array(
						'title'			=> 'Puppet Show',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> '',
					),
					array(
						'title'			=> 'Electone',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> '',
					),
		    	)),
			),

			// daftars widget horizontal
			array(
				'widget_id' 	=> 2,
				'type'		 	=> 'horizontal',
				'title' 		=> 'Keunggulan',
				'slug'	 		=> 'Keunggulan',
				'description' 	=> 'Daftar Keunggulan Kami',
				'content'		=> json_encode(array(
					array(
						'title'			=> 'Proses Kami',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,'
					),
					array(
						'title'			=> 'Kualitas Acara',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,'
					),
				)),
			),
		);

		DB::table('widgets_groups')->insert($widgets_groups);
		/* End Widgets_Groups */

		/* Widgets_Groups_Items *
		DB::table('widgets_items')->truncate();

		$widgets_items 	= array(
			// banner widget
			array(
				'widget_id' 		=> null,
				'widget_group_id'	=> 1,
				'parent_id'			=> null,
				'order'				=> 0,
				'title'				=> 'banner ke 1',
				'content'			=> json_encode(array(
		    		'title'			=> 'Banner ke 1',
		    		'link'			=> 'http://google.co.id',
		    		'description' 	=> 'ini adalah banner ke 1',
		    		'file'			=> 'http://asmoyo.dev/uploads/medium/example.jpg'
		    	)),
			),
			array(
				'widget_id' 		=> null,
				'widget_group_id'	=> 1,
				'parent_id'			=> null,
				'order'				=> 1,
				'title'				=> 'banner ke 2',
				'content'			=> json_encode(array(
					'title'			=> 'Banner ke 2',
		    		'link'			=> 'http://facebook.com',
		    		'description' 	=> 'ini adalah banner ke 2',
		    		'file'			=> 'http://asmoyo.dev/uploads/medium/example.jpg'
				)),
			),
			// end banner widget

			// daftars widget vertical
			array(
				'widget_id' 		=> null,
				'widget_group_id'	=> 2,
				'parent_id'			=> null,
				'order'				=> null,
				'title'				=> '',
				'content'			=> json_encode(array(
					array(
						'title'			=> 'Dekorasi Balon',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> '',
					),
					array(
						'title'			=> 'MC Badut (Ulang Tahun)',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> '',
					),
					array(
						'title'			=> 'Boneka Karakter',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> '',
					),
					array(
						'title'			=> 'Puppet Show',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> '',
					),
					array(
						'title'			=> 'Electone',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> '',
					),
				)),
			),
			// end daftars widget vertical

			// daftars widget horizontal
			array(
				'widget_id' 		=> null,
				'widget_group_id'	=> 3,
				'parent_id'			=> null,
				'order'				=> null,
				'title'				=> '',
				'content'			=> json_encode(array(
					array(
						'title'			=> 'Proses Kami',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,'
					),
					array(
						'title'			=> 'Kualitas Acara',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,'
					),
					array(
						'title'			=> 'Tim dan Crew',
						'link'			=> '',
						'icon'			=> '',
						'description'	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,'
					),
				)),
			),
			// end daftars widget vertical
		);

		DB::table('widgets_items')->insert($widgets_items);
		/* End Widgets_Groups_Items */

	}

}