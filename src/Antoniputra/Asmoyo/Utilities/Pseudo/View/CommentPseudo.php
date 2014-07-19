<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\View;

use View, App;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class CommentPseudo extends Pseudo
{
	public function translate($attr)
	{
		$repo = App::make('Antoniputra\Asmoyo\Comments\CommentInterface');

		$attr['type'] 	= array_get($attr, 'type') ?: 'list';
		$attr['limit']	= $repo->repoLimit( array_get($attr, 'limit') );
		$attr['sortir']	= $repo->repoSortir( array_get($attr, 'sortir') );
		$attr['id']		= array_get($attr, 'id') ?: null;
		
		$data = array('attr' => $attr);

		switch ($attr['type'])
		{
			case 'list':
				$data['repo'] = $repo->getAll($attr['limit'], $attr['sortir']);
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