<?php

class WidgetTableSeeder extends Seeder {

	public function run()
	{
		/* Widgets */
		DB::table('widgets')->truncate();

		$widgets 	= array(
			array(
			    'title'			=> 'Text',
			    'slug'			=> 'text',
			    'description' 	=> 'Daftar text custom',
			    'supported' 	=> 'all',
			    'has_item'		=> 1,
			    'attribute'		=> json_encode(array(
			    	'field' => array(
		    			'text'		=> 'textarea',
	    			),
		    	)),
			),

			array(
			    'title' 		=> 'Listing',
			    'slug'		 	=> 'listing',
			    'description'	=> 'Buat flexible custom list',
			    'supported'	 	=> 'all',
			    'has_item'		=> 1,
			    'attribute'		=> json_encode(array(
			    	'field' => array(
		    			'title'		=> 'text',
		    			'link'		=> 'text',
		    			'description' => 'textarea',
	    			),
		    	)),
			),

			array(
			    'title' 		=> 'Search',
			    'slug'		 	=> 'search',
			    'description'	=> 'Form searching',
			    'supported'	 	=> 'all',
			    'has_item'		=> 0,
			    'attribute'		=> json_encode(array()),
			),
		);

		DB::table('widgets')->insert($widgets);
		/* End Widgets */

		/* Widgets_Items */
		DB::table('widgets_items')->truncate();

		$widgets_items 	= array(
			array(
				'widget_id'		=> 1,
				'title'			=> 'Informasi',
				'description'	=> 'ini adalah informasi saja',
				'content'		=> json_encode(array(
					'text'	=> nl2br('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
				)),
			),
			array(
				'widget_id'		=> 2,
				'title'			=> 'Layanan Kami',
				'description'	=> 'ini adalah listing untuk layanan kami',
				'content'		=> json_encode(array(
					array(
						'title'			=> 'Dekorasi Balon (Special Kids & Sweet Party)',
		    			'link'			=> 'http://baretshow.com',
		    			'description' 	=> nl2br('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat'),
	    			),
	    			array(
						'title'			=> 'MC - Presenter (All Party)',
		    			'link'			=> 'http://baretshow.com',
		    			'description' 	=> nl2br('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat'),
	    			),
	    			array(
						'title'			=> 'Badut Professional & Akrobat',
		    			'link'			=> 'http://baretshow.com',
		    			'description' 	=> nl2br('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat'),
	    			),
	    			array(
						'title'			=> 'Puppet Show - VentryLoquis',
		    			'link'			=> 'http://baretshow.com',
		    			'description' 	=> nl2br('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat'),
	    			),
	    			array(
						'title'			=> 'Sanggar Lukis',
		    			'link'			=> 'http://baretshow.com',
		    			'description' 	=> nl2br('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat'),
	    			),
				)),
			),
		);
		
		DB::table('widgets_items')->insert($widgets_items);
		/* End Widgets_Groups */
	}

}