<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo;

use Antoniputra\Asmoyo\Utilities\Pseudo\View as PseudoView;

abstract class Pseudo {
    
    /**
    * concrete method for child object
    * @param $attr attribute pseudo
    */
	abstract public function translate($attr);

    /**
    * Rendering template or view for generate pseudo
    * @param $tpl view
    */
	public static function render($tpl)
	{
		$original = $tpl;

		// {<asmoyo:content param=value>}
		preg_match_all('/\{<(asmoyo:[^}]+)\>}/', $tpl, $matches);

		foreach ($matches[1] as $elem)
		{
			$prop 	= explode('&', preg_replace('/\s+/', '&', $elem));
			$object = substr(array_shift($prop), strlen('asmoyo:'));

			parse_str(implode('&', $prop), $prop);

			switch ($object)
			{
				case 'post':
					$obj = new PseudoView\PostPseudo;
				break;
				case 'media':
					$obj = new PseudoView\MediaPseudo;
				break;
				case 'category':
					$obj = new PseudoView\CategoryPseudo;
				break;
				case 'comment':
					$obj = new PseudoView\CommentPseudo;
				break;
				case 'widget':
					$obj = new PseudoView\WidgetPseudo;
				break;
				default:
					$obj = false;
				break;
			}

			if ($obj instanceof Self)
			{
				$tpl = str_replace( '{<'.$elem.'>}', call_user_func_array(
					array($obj, 'translate'), 
					array($prop)
				), $tpl);
			}
			else
			{
				// here is handle missing pseudo
				$tpl = str_replace('{<'.$elem.'>}', '', $tpl);
			}
		}

		if ($tpl != FALSE)
			return $tpl;
		else
			return $original;
	}

	public static function read($str)
	{
		$original = $str;

		preg_match_all('/\{<(asmoyo:[^}]+)\>}/', $str, $matches);
		if( isset($matches[1][0]) )
		{
			$prop = explode('&', preg_replace('/\s+/', '&', $matches[1][0]));
			$object = substr(array_shift($prop), strlen('asmoyo:'));
			parse_str(implode('&', $prop), $prop);

			// add object key to prop and return
			return array_merge( array('object' => $object), $prop );
		}
		return $original;
	}

	public static function getList()
	{
		$lists 	= array();
		$widgets = app('Antoniputra\Asmoyo\Widgets\WidgetInterface')->getAll();
		foreach ($widgets['items'] as $w)
		{
			if($w['groups']) {
				foreach ($w['groups'] as $g)
				{
					$lists[] = array(
						'name'			=> $w['title'],
						'widget_name'	=> $w['slug'],
						'group_name'	=> $g['slug'],
						'title' 		=> $g['title'],
						'description' 	=> $g['description'],
						'pseudo'	=> array(
							'id'			=> $g['id'],
							'object'		=> 'widget',
							'type'			=> 'list',
							'sortir'		=> 'new',
						),
					);
				}
			}
		}

		return array_merge($lists, self::objectList());
	}

	public static function objectList()
	{
		return array(
			array(
				'name'			=> 'Post',
				'title' 		=> '',
				'widget_name'	=> '',
				'group_name'	=> '',
				'description' 	=> 'ini adalah description',
				'pseudo'	=> array(
					'id'			=> null,
					'object'		=> 'post',
					'type'			=> 'list',
					'sortir'		=> 'new',
				),
			),
			array(
				'name'			=> 'Media',
				'title' 		=> '',
				'widget_name'	=> '',
				'group_name'	=> '',
				'description' 	=> 'ini adalah description',
				'pseudo'	=> array(
					'id'			=> null,
					'object'		=> 'media',
					'type'			=> 'list',
					'sortir'		=> 'new',
				),
			),
			array(
				'name'			=> 'Category',
				'title' 		=> '',
				'widget_name'	=> '',
				'group_name'	=> '',
				'description' 	=> 'ini adalah description',
				'pseudo'	=> array(
					'id'			=> null,
					'object'		=> 'category',
					'type'			=> 'list',
					'sortir'		=> 'new',
				),
			),
			array(
				'name'			=> 'Comment',
				'title' 		=> '',
				'widget_name'	=> '',
				'group_name'	=> '',
				'description' 	=> 'ini adalah description',
				'pseudo'	=> array(
					'id'			=> null,
					'object'		=> 'comment',
					'type'			=> 'list',
					'sortir'		=> 'new',
				),
			),
		);
	}

	public static function typeList()
	{
		return array(
			'list'			=> 'list',
			'grid'			=> 'grid',
			'media-object'	=> 'media-object',
			'detail'		=> 'detail',
		);
	}

	public static function sortirList()
	{
		return array(
			'new'				=> 'new',
			'latest-updated'	=> 'latest-updated',
			'title-ascending'	=> 'title-ascending',
			'title-descending'	=> 'title-descending',
			'popular'			=> 'popular',
		);
	}
}