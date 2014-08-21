<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\Object;

use View, App;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class WidgetPseudo extends Pseudo
{
	public function translate($attr)
	{
		$repo 	= App::make('Antoniputra\Asmoyo\Widgets\WidgetInterface');
		$attr 	= array(
			'name'	=> array_get($attr, 'name') ?: null,
			'item'	=> array_get($attr, 'item') ?: 0,
		);

		$widget = $repo->getBySlug($attr['name'], $attr['item']);

		$data = array(
			'attr' 		=> $attr,
			'widget' 	=> $widget,
			'item'	 	=> $widget['item'],
		);
		$file = $this->path('widget');
		return View::make($file, $data)->render();
	}
}