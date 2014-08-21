<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\Object;

use View, App;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class WidgetPseudo extends Pseudo
{
	public function translate($attr)
	{
		$repo 	= App::make('Antoniputra\Asmoyo\Widgets\WidgetInterface');
		$attr 	= array(
			'slug'	=> array_get($attr, 'slug') ?: null,
			'item'	=> array_get($attr, 'item') ?: 0,
		);

		$data = array(
			'attr' 		=> $attr,
			'widget' 	=> $repo->getBySlug($attr['slug'], $attr['item'])
		);
		return View::make('asmoyo::pseudo.widget', $data)->render();
	}

}