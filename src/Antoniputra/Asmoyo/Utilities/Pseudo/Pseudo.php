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
				case 'comment':
					$obj = new PseudoView\CommentPseudo;
				break;
				case 'category':
					$obj = new PseudoView\CategoryPseudo;
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
}