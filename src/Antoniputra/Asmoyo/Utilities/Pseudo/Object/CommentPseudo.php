<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\Object;

use View, App;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class CommentPseudo extends Pseudo
{
	public function translate($attr)
	{
		$repo 	= App::make('Antoniputra\Asmoyo\Comments\CommentInterface');
		$attr 	= array(
			'type' 		=> array_get($attr, 'type') ?: 'list',
			'limit'		=> $repo->repoLimit( array_get($attr, 'limit') ),
			'sortir'	=> $repo->repoSortir( array_get($attr, 'sortir') ),
			'id'		=> array_get($attr, 'id') ?: null,
		);
		
		$data = array('attr' => $attr);

		switch ($attr['type'])
		{
			case 'list':
				$data['repo'] = $repo->getAll($attr['limit'], $attr['sortir']);
			break;

			case 'media-object':
				
			break;

			case 'detail':
				
			break;
			
			default:
				return '';
			break;
		}
		return View::make('asmoyo::pseudo.comment', $data);
	}
}