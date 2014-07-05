<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\View;

use View, App;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class CommentPseudo extends Pseudo
{
	public function translate($attr)
	{
		$repo = App::make('Antoniputra\Asmoyo\Comments\CommentInterface');

		$attr['type'] 	= array_get($attr, 'type') ?: 'list';
		$attr['sortir']	= array_get($attr, 'sortir') ?: 'new';
		$attr['limit']	= array_get($attr, 'limit') ?: 3;
		$attr['id']		= array_get($attr, 'id') ?: null;
		
		$data = array('attr' => $attr);

		switch ($attr['type'])
		{
			case 'list':
				$data['repo'] = $repo->getAll($attr['sortir'], $attr['limit']);
				return View::make('asmoyo::pseudo.comment', $data);
			break;

			case 'media-object':
				
			break;

			case 'detail':
				
			break;
			
			default:
				
			break;
		}
	}
}