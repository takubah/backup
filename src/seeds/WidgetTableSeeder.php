<?php

class WidgetTableSeeder extends Seeder {

	public function run()
	{
		/* Widgets */
		DB::table('widgets')->truncate();

		$widgets 	= array(
			array(
				'objectable_id' 	=> null,
				'objectable_type' 	=> null,
			    'title' 			=> 'bootstrap-banner',
			    'description' 		=> 'bootstrap banner for your banner',
			    'content'	 		=> '',
			    'view_path'			=> 'bootstrap-banner',
			    'is_hasMany'  		=> 1,
			    'status'	  		=> 'installed',
			),
		);

		DB::table('widgets')->insert($widgets);
		/* End Widgets */

		/* Widgets_Groups */
		DB::table('widgets_groups')->truncate();

		$widgets_groups 	= array(
			array(
				'widget_id' 		=> 1,
				'title' 			=> 'Banner Utama',
				'description' 		=> 'Banner utama pada homepage',
			),
		);

		DB::table('widgets_groups')->insert($widgets_groups);
		/* End Widgets_Groups */

		/* Widgets_Groups_Items */
		DB::table('widgets_items')->truncate();

		$widgets_items 	= array(
			array(
				'widget_id' 		=> null,
				'widget_group_id'	=> 1,
				'parent_id'			=> null,
				'order'				=> 0,
				'objectable_id'		=> null,
				'objectable_type'	=> null,
				'title'				=> 'banner ke 1',
				'content'			=> json_encode(array(
						'file'			=> 'bootstrap-banner1.jpg',
						'description'	=> 'ini adalah banner yang ke 1'
				)),
			),
			array(
				'widget_id' 		=> null,
				'widget_group_id'	=> 1,
				'parent_id'			=> null,
				'order'				=> 1,
				'objectable_id'		=> null,
				'objectable_type'	=> null,
				'title'				=> 'banner ke 2',
				'content'			=> json_encode(array(
						'file'			=> 'bootstrap-banner2.jpg',
						'description'	=> 'ini adalah banner yang ke 2'
				)),
			),
		);

		DB::table('widgets_items')->insert($widgets_items);
		/* End Widgets_Groups_Items */

	}

}