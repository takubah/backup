<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo;

use Illuminate\View\Environment as BaseEnvironment;
use Illuminate\View\View;
use Antoniputra\Asmoyo\Utilities\Pseudo\View as PseudoView;

class Pseudo extends BaseEnvironment {
    /**
     * Get a evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\View\View
     */
    public function render($view, $data = array(), $mergeData = array())
    {
        $path = $this->finder->find($view);

        $data = array_merge($mergeData, $this->parseData($data));

        $newView = new View($this, $this->getEngineFromPath($path), $view, $path, $data);

        // Pseudo Logic Here
        $this->callCreator($view = new View($this, $this->getEngineFromPath($path), $view, $path, $data));

        return $this->translate($view);
    }


    /**
    * translate
    */
	public function translate($str)
	{
		$original = $str;

		// {<asmoyo:content param=value>}
		preg_match_all('/\{<(asmoyo:[^}]+)\>}/', $str, $matches);

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
				case 'widget':
					$obj = new PseudoView\WidgetPseudo;
				break;
			}

			$str = str_replace( '{<'.$elem.'>}', call_user_func_array(
				array($obj, 'translate'), 
				array($prop)
			), $str);
		}

		if ($str != FALSE)
			return $str;
		else
			return $original;
	}
}