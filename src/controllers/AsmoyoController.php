<?php

use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class AsmoyoController extends Controller {

	protected $viewStructure;

	public function setStructure($file, $type='public')
	{
		$web = app('asmoyo.web');
		if($type == 'public')
		{
			$this->viewStructure = 'asmoyoTheme.'. $web['web_publicTemplate'] .'.'. $file;
		} elseif($type == 'admin' ) {
			// check if there is not asmoyo:: str, add it !
			$this->viewStructure =  (false === strpos($file, 'asmoyo::'))
				? 'asmoyo::'. $web['web_adminTemplate'] .'.'. $file
				: $file;
		}

		return $this;
	}

	public function loadView($content, $data = array(), $disabledPseudo=false)
	{
		include __DIR__ . '/../composers.php';

		$web = app('asmoyo.web');
		
		// set view structure if empty
		if(!$this->viewStructure) {
			$this->viewStructure = ( Request::segment(1) == 'admin' ) 
				? 'asmoyo::admin.twoCollumn'
				: 'asmoyoTheme.'. $web['web_publicTemplate'] .'.twoCollumn';
		}

		// check content path for publicTemplate, if there is not asmoyoTheme str, add it !
		if(false === strpos($content, 'asmoyoTheme') AND Request::segment(1) != Config::get('asmoyo::admin.url'))
		{
			$content = 'asmoyoTheme.'. $web['web_publicTemplate'] .'.'. $content;
		}
		// check content path for adminTemplate, if there is not asmoyoTheme str, add it !
		elseif(false === strpos($content, 'asmoyo::') AND Request::segment(1) == Config::get('asmoyo::admin.url'))
		{
			$content = 'asmoyo::'. $web['web_adminTemplate'] .'.'. $content;
		}

		$view = View::make( $this->viewStructure , $data)->nest('content', $content, $data);
		return ($disabledPseudo) ? $view : Pseudo::render($view);
	}

	protected function getAssets($theme, $file)
	{
		try
		{
			$web 	= app('asmoyo.web');

			// admin
			if($theme == $web['web_adminTemplate'])
			{
				$path 	= public_path('packages/antoniputra/asmoyo/'. $web['web_adminTemplate'].'/'.$file );
			}
			// public
			elseif($theme == $web['web_publicTemplate'])
			{
				$path 	= public_path('themes/'. $web['web_publicTemplate'] .'/'.$file );
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

	protected function getMedia($size, $file)
	{
		$path 	= public_path('uploads/images/'. $size .'/'.$file );
		return Response::make( File::get($path) )
			->header('Content-Type', getMime(File::extension($path)) );
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
			return $redirect->with('flash_message', array(
				'alertType'		=> $alertType,
				'alertTitle'	=> $alertTitle,
				'alertText'		=> $alertText
			))->withInput();
		}
		// if redUrl, that mean do Redirect::route and add alert
		elseif( !is_null($alertTitle) )
		{
			return $redirect->with('flash_message', array(
				'alertType'		=> $alertType,
				'alertTitle'	=> $alertTitle,
				'alertText'		=> $alertText
			));
		}

		// if nothing alert just do Redirect::route
		return $redirect;
	}
}
