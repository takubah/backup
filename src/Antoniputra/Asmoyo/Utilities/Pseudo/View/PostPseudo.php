<?php namespace Antoniputra\Asmoyo\Utilities\Pseudo\View;

use View, App;
use Antoniputra\Asmoyo\Posts\PostRepo;

class PostPseudo
{
	public function translate($attr)
	{
		$repo = App::make('Antoniputra\Asmoyo\Posts\PostInterface');
		$data = array('attr' => $attr);

		switch ($attr['type'])
		{
			case 'list':
				$data['repo'] = $repo->getAll();
				return View::make('asmoyo::pseudo.post', $data);
			break;

			case 'inline':
				
			break;
			
			default:
				
			break;
		}
	}

}