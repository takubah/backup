<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\View;

use View, App;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class WidgetPseudo extends Pseudo
{
	public function translate($attr)
	{
		$widget = App::make('Antoniputra\Asmoyo\Widgets\WidgetInterface');
		$attr = array(
			'widget-name' => array_get($attr, 'widget-name') ?: '',
			'group-name' => array_get($attr, 'group-name') ?: '',
			'type'	 	=> array_get($attr, 'type') ?: 'list',
			'limit'		=> $widget->repoLimit( array_get($attr, 'limit') ),
			'sortir'	=> $widget->repoSortir( array_get($attr, 'sortir') ),
			'status'	=> $widget->repoSortir( array_get($attr, 'status') ),
			'size'	 	=> array_get($attr, 'size') ?: '100px' ,
		);
		$data = array(
			'attr' 		=> $attr,
			'widget' 	=> $widget->getBySlugWithGroup($attr['widget-name'], $attr['group-name'])
		);
		return View::make('asmoyo::pseudo.widget', $data)->render();
	}

}