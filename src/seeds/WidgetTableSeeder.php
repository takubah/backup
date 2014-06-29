<?php

class WidgetTableSeeder extends Seeder {

	public function run()
	{
		/* Widgets */
		DB::table('widgets')->truncate();

		$widgets 	= array(
			array(
			    'title' 			=> 'Asmoyo Bootstrap Banner',
			    'slug'	 			=> 'asmoyo-bootstrap-banner',
			    'description' 		=> 'bootstrap banner for banner',
			    'is_hasMany'  		=> 1,
			    'content'	 		=> '',
			    'view_path'			=> 'asmoyo-bootstrap-banner',
			    'status'	  		=> 'enabled',
			),

			array(
			    'title' 			=> 'Asmoyo Daftars',
			    'slug'	 			=> 'asmoyo-daftars',
			    'description' 		=> 'make list for your web info',
			    'is_hasMany'  		=> 1,
			    'content'	 		=> '',
			    'view_path'			=> 'asmoyo-daftars',
			    'status'	  		=> 'enabled',
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
				'description' 		=> 'Banner utama pada homepage',
			),

			// daftars widget vertical
			array(
				'widget_id' 		=> 2,
				'type'		 		=> 'vertical',
				'title' 			=> 'Layanan Kami',
				'description' 		=> 'Daftar Layanan Kami',
			),

			// daftars widget horizontal
			array(
				'widget_id' 		=> 2,
				'type'		 		=> 'horizontal',
				'title' 			=> 'Keunggulan',
				'description' 		=> 'Daftar Keunggulan Kami',
			),
		);

		DB::table('widgets_groups')->insert($widgets_groups);
		/* End Widgets_Groups */

		/* Widgets_Groups_Items */
		DB::table('widgets_items')->truncate();

		$widgets_items 	= array(
			// banner widget
			array(
				'widget_id' 		=> null,
				'widget_group_id'	=> 1,
				'parent_id'			=> null,
				'order'				=> 0,
				'title'				=> 'banner ke 1',
				'content'			=> json_encode(
					array(
						'file'			=> 'bootstrap-banner1.jpg',
						'description'	=> 'ini adalah banner yang ke 1'
					)
				),
			),
			array(
				'widget_id' 		=> null,
				'widget_group_id'	=> 1,
				'parent_id'			=> null,
				'order'				=> 1,
				'title'				=> 'banner ke 2',
				'content'			=> json_encode(
					array(
						'file'			=> 'bootstrap-banner2.jpg',
						'description'	=> 'ini adalah banner yang ke 2'
					)
				),
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