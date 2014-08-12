<?php

use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class AsmoyoController extends Controller {

	protected $viewStructure;

	public function setStructure($file, $type='public')
	{
		$web = app('asmoyo.web');
		if($type == 'public')
		{
			$this->viewStructure = 'asmoyoTheme.'. $web['web_publicTemplate']['name'] .'.'. $file;
		} elseif($type == 'admin' ) {
			// check if there is not asmoyo:: str, add it !
			$this->viewStructure =  (false === strpos($file, 'asmoyo::'))
				? 'asmoyo::'. $web['web_adminTemplate']['name'] .'.'. $file
				: $file;
		}

		return $this;
	}

	public function loadView($content, $data = array())
	{
		$web = app('asmoyo.web');
		
		// set view structure if empty
		if(!$this->viewStructure) {
			$this->viewStructure = ( Request::segment(1) == 'admin' ) 
				? 'asmoyo::admin.twoCollumn'
				: 'asmoyoTheme.'. $web['web_publicTemplate']['name'] .'.twoCollumn';
		}

		// check content path for publicTemplate, if there is not asmoyoTheme str, add it !
		if(false === strpos($content, 'asmoyoTheme') AND Request::segment(1) != Config::get('asmoyo::admin.url'))
		{
			$content = 'asmoyoTheme.'. $web['web_publicTemplate']['name'] .'.'. $content;
		}
		// check content path for adminTemplate, if there is not asmoyoTheme str, add it !
		elseif(false === strpos($content, 'asmoyo::') AND Request::segment(1) == Config::get('asmoyo::admin.url'))
		{
			$content = 'asmoyo::'. $web['web_adminTemplate']['name'] .'.'. $content;
		}

		$view = View::make( $this->viewStructure , $data)->nest('content', $content, $data)->render();
		return Pseudo::render($view);
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
			else {
				$path 	= public_path('themes/'. $theme .'/'. $file);
			}

			return Response::make( File::get($path) )
				->header('Content-Type', getMime(File::extension($path)) );
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
			return Response::make( File::get($requestedFile) )
				->header('Content-Type', getMime(File::extension($requestedFile)));
		} else {
			$default = $path . app('asmoyo.web')['media_imageDefault'];
			return Response::make( File::get($default) )
				->header('Content-Type', getMime(File::extension($default)) );
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
