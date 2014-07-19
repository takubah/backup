<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\View;

use View, App;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class CategoryPseudo extends Pseudo
{
	public function translate($attr)
	{
		$repo = App::make('Antoniputra\Asmoyo\Categories\CategoryInterface');

		$attr['type'] 	= array_get($attr, 'type') ?: 'list';
		$attr['limit']	= array_get($attr, 'limit') ?: 3;
		$attr['sortir']	= array_get($attr, 'sortir') ?: 'new';
		$attr['id']		= array_get($attr, 'id') ?: null;

		$data = array('attr' => $attr);

		switch ($attr['type'])
		{
			case 'list':
				$data['repo'] = $repo->getStructure($attr['limit'], $attr['sortir']);
				return View::make('asmoyo::pseudo.category', $data);
			break;

			case 'grid':
				
			break;

			case 'media-object':
				
			break;

			case 'detail':
				
			break;

			case 'inline':
				
			break;
			
			default:
				
			break;
		}
	}

}