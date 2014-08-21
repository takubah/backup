<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo;

use Antoniputra\Asmoyo\Utilities\Pseudo\Object as PseudoObject;

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
					$obj = new PseudoObject\PostPseudo;
				break;
				case 'media':
					$obj = new PseudoObject\MediaPseudo;
				break;
				case 'category':
					$obj = new PseudoObject\CategoryPseudo;
				break;
				case 'comment':
					$obj = new PseudoObject\CommentPseudo;
				break;
				case 'widget':
					$obj = new PseudoObject\WidgetPseudo;
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

	/**
	* get pseudo translate view
	*/
	protected function path($file)
	{
		$web 	= app('asmoyo.web');
		return 'asmoyoTheme.'. $web['web_publicTemplate']['name'] .'.pseudo.'.$file;
	}
}