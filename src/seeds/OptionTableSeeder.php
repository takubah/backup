<?php

class OptionTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('options')->truncate();

		$options = array(

			// General
			array(
				'name'			=> 'web_title',
				'value'			=> 'My Website',
				'description'	=> 'My website title ',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_logo',
				'value'			=> 'logo.png',
				'description'	=> 'My Logo',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_description',
				'value'			=> 'My First Website, Discover my life, and another.',
				'description'	=> '',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_email',
				'value'			=> 'plensip@gmail.com',
				'description'	=> 'Web Email system',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_itemPerPage',
				'value'			=> 10,
				'description'	=> 'Number showed Item for global list data',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_itemSortir',
				'value'			=> 'new',
				'description'	=> 'Sortir item for global list data',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_timezone',
				'value'			=> 'UTC',
				'description'	=> 'Web Timezone',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_dateFormat',
				'value'			=> 'l, jS F Y - H:i A',
				'description'	=> 'Web Date Format',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_ga',
				'value'			=> 'UA-50837694-2',
				'description'	=> 'Web Google Analytics',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_metaTitle',
				'value'			=> 'Plensip Website',
				'description'	=> 'Your website meta title',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_metaKeyword',
				'value'			=> 'Plensip Website',
				'description'	=> 'Your website meta keyword',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_metaDescription',
				'value'			=> 'Plensip Website',
				'description'	=> 'Your website meta description',
				'type'			=> '',
			),
			array(
				'name'			=> 'web_publicTemplate',
				'value'			=> json_encode(array(
					'name'	=> 'baretshow',
					'info'	=> array(
						'structure'	=> array('oneCollumn', 'twoCollumn'),
					),
				)),
				'description'	=> nl2br('Elegant Company Profile Template

					<ul>
						<li>Support One Collumn</li>
						<li>Support Two Collumn (Sidebar Right) </li>
						<li>Support Widget (latest article list, service list) </li>
					</ul>
				'),
				'type'			=> 'json',
			),
			array(
				'name'			=> 'web_adminTemplate',
				'value'			=> json_encode(array(
					'name'	=> 'admin',
					'info'	=> array(
						'structure'	=> array('oneCollumn', 'twoCollumn'),
					),
				)),
				'description'	=> nl2br('Elegant Admin Template
					bla bla
				'),
				'type'			=> 'json',
			),

			array(
				'name'			=> 'web_sideLeft',
				'value'			=> json_encode(array(
					array(
						'title'	 	=> 'Daftar Posting Baru',
						'content'	=> '{<asmoyo:post type=list sortir=new size=80px>}',
					),
				)),
				'description'	=> 'item sidebar left',
				'type'			=> 'json',
			),
			array(
				'name'			=> 'web_sideRight',
				'value'			=> json_encode(array(
					array(
						'title'	 	=> 'Kategori',
						'content'	=> '{<asmoyo:category type=grid sortir=title-descending size=80px>}',
					),
				)),
				'description'	=> 'item sidebar right',
				'type'			=> 'json',
			),


			// Media
			array(
				'name'			=> 'media_imageDefault',
				'value'			=> 'default.jpg',
				'description'	=> 'Image default',
				'type'			=> '',
			),
			array(
				'name'			=> 'media_smallSize',
				'value'			=> json_encode(array('w' => 180, 'h' => 135)),
				'description'	=> 'Image Small Size in pixel',
				'type'			=> 'json',
			),
			array(
				'name'			=> 'media_mediumSize',
				'value'			=> json_encode(array('w' => 500, 'h' => 375)),
				'description'	=> 'Image Medium Size in pixel',
				'type'			=> 'json',
			),
			array(
				'name'			=> 'media_largeSize',
				'value'			=> json_encode(array('w' => 1024, 'h' => 768)),
				'description'	=> 'Image Large Size in pixel',
				'type'			=> 'json',
			),
			array(
				'name'			=> 'media_constraint',
				'value'			=> json_encode(array(
						'aspectRatio' 	=> 1,
						'upsize' 		=> 1,
				)),
				'description'	=> 'Image Large Size in pixel',
				'type'			=> 'json',
			),
			array(
				'name'			=> 'media_watermark',
				'value'			=> json_encode(array(
						'type'		=> 'image',
						'text'		=> '',
						'image'		=> 'logo.png',
						'position'	=> 'center',
				)),
				'description'	=> 'Image Watermark use by text or image',
				'type'			=> 'json',
			),
			// End Media

		);

		// Uncomment the below to run the seeder
		DB::table('options')->insert($options);
	}

}
