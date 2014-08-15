<?php

use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class AsmoyoController extends Controller {

	protected $structure;

	public function setStructure($file, $type='public')
	{
		$web = app('asmoyo.web');

		if ($type == 'public')
		{
			$this->structure = 'asmoyoTheme.'. $web['web_publicTemplate']['name'] .'.'. $file;
		}
		elseif ($type == 'admin')
		{
			$this->structure = 'asmoyo::'. $web['web_adminTemplate']['name'] .'.'. $file;
		}
		return $this;
	}

	public function adminView($content, $data = array())
	{
		$web 	= app('asmoyo.web');
		$base 	= 'asmoyo::.'. $web['web_adminTemplate']['name'] .'.';
		if ( ! $this->structure )
		{
			$this->structure = $base .'oneCollumn';
		}
		$content = $base . $content;

		return Pseudo::render(
			View::make(
				$this->structure, $data)
					->nest('content', $content, $data)
					->render()
		);
	}

	public function loadView($content, $data = array())
	{
		$web 	= app('asmoyo.web');
		$base 	= 'asmoyoTheme.'. $web['web_publicTemplate']['name'] .'.';
		if ( ! $this->structure )
		{
			$this->structure = $base .'oneCollumn';
		}
		$content = $base . $content;

		return Pseudo::render(
			View::make(
				$this->structure, $data)
					->nest('content', $content, $data)
					->render()
		);
	}

	protected function getAssets($theme, $file)
	{
		try
		{
			$web 	= app('asmoyo.web');

			// admin
			if($theme == $web['web_adminTemplate']['name'])
			{
				$path 	= public_path('packages/antoniputra/asmoyo/'. $web['web_adminTemplate']['name'].'/'.$file );
			}
			// public
			elseif($theme == $web['web_publicTemplate']['name'])
			{
				$path 	= public_path('themes/'. $web['web_publicTemplate']['name'] .'/'.$file );
			}
			// other
			else
			{
				$path 	= public_path('themes/'. $theme .'/'. $file);
			}

			return Response::make( File::get($path), 200, array( 'Content-Type' => getMime(File::extension($path)) ))
				->setCache(array(
					// 'last_modified' => DateTime::createFromFormat('Y-m-d G:i:s', date('Y-m-d G:i:s', filemtime($path)) ),
					'max_age' 		=> 86400, // One day
					'public' 		=> true,   // Allow public caches to cache
				));
		}
		catch(Exception $e)
		{
			return App::abort(404, $e);
		}
	}

	protected function getMedia($size, $file='default')
	{
		$path 	= \Config::get('asmoyo::config.uploads.path_image').$size.'/';
		$requestedFile = $path . $file;
		if( is_file($requestedFile) )
		{
			return Response::make(File::get($requestedFile), 200, array('Content-Type' => getMime(File::extension($requestedFile))));
		} else {
			$default = $path . app('asmoyo.web')['media_imageDefault'];
			return Response::make(File::get($default), 200, array('Content-Type' => getMime(File::extension($default))) );
		}
	}

	protected function redirectAlert($to=null, $alertType='info', $alertTitle=null, $alertText=null)
	{
		if(filter_var($to, FILTER_VALIDATE_URL))
		{
			$redirect = \Redirect::to($to);
		}
		elseif($to)
		{
			$redirect = \Redirect::route($to);
		}
		else
		{
			$redirect = \Redirect::back();
		}

		// if null, do redirect back and add withInput
		if( !$to )
		{
			return $redirect->with('alert', array(
				'type'		=> $alertType,
				'title'		=> $alertTitle,
				'text'		=> $alertText
			))->withInput();
		}
		// if redUrl, that mean do Redirect::route and add alert
		elseif( !is_null($alertTitle) )
		{
			return $redirect->with('alert', array(
				'type'		=> $alertType,
				'title'		=> $alertTitle,
				'text'		=> $alertText
			));
		}

		// if nothing alert just do Redirect::route
		return $redirect;
	}
}
