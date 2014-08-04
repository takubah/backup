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
					return $tpl;
				break;
			}

			$tpl = str_replace( '{<'.$elem.'>}', call_user_func_array(
				array($obj, 'translate'), 
				array($prop)
			), $tpl);
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

	public static function objectList()
	{
		return array(
			'post'		=> 'post',
			'media'		=> 'media',
			'category'	=> 'category',
			'comment'	=> 'comment',
			'widget'	=> 'widget',
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