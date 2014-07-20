<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\View;

use View, App;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class CategoryPseudo extends Pseudo
{
	public function translate($attr)
	{
		$repo = App::make('Antoniputra\Asmoyo\Categories\CategoryInterface');

		$attr['type'] 	= array_get($attr, 'type') ?: 'list';
		$attr['limit']	= $repo->repoLimit( array_get($attr, 'limit') );
		$attr['sortir']	= $repo->repoSortir( array_get($attr, 'sortir') );
		$attr['id']		= array_get($attr, 'id') ?: null;

		$data = array('attr' => $attr);

		switch ($attr['type'])
		{
			case 'list':
				$data['repo'] = $repo->getStructure($attr['limit'], $attr['sortir']);
				return View::make('asmoyo::pseudo.category', $data)->render();
			break;

			case 'grid':
				$data['attr']['size'] = array_get($attr, 'size') ?: '100px' ;
				$data['repo'] = $repo->getAll($attr['limit'], $attr['sortir'], 'published');
				return View::make('asmoyo::pseudo.category', $data)->render();
			break;

			case 'media-object':
				$data['attr']['description'] = array_get($attr, 'description') ?: 1 ;
				$data['attr']['size'] 		= array_get($attr, 'size') ?: '100px' ;
				$data['repo'] = $repo->getAll($attr['limit'], $attr['sortir'], 'published');
				return View::make('asmoyo::pseudo.category', $data)->render();
			break;

			case 'detail':
				$data['attr']['id'] 	= array_get($attr, 'id');
				$data['attr']['slug'] 	= array_get($attr, 'slug');
				$data['attr']['size'] 	= array_get($attr, 'size') ?: '100px' ;
				
				if($id = $data['attr']['id']) {
					$repo = $repo->getById($id);
				} elseif($slug = $data['attr']['slug']) {
					$repo = $repo->getBySlug($slug);
				} else {
					return '';
				}

				$data['repo'] = $repo;
				return View::make('asmoyo::pseudo.category', $data)->render();
			break;
			
			default:
				return '';
			break;
		}
	}

}