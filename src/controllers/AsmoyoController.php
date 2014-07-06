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

	public function assetsAdmin($file)
	{
		try
		{
			$web = app('asmoyo.web');
			$content = file_get_contents(public_path( 
				'packages/antoniputra/asmoyo/'. $web['web_adminTemplate'].'/'.$file
			));
			return Response::make($content)
				->header('Content-Type', $this->assetHeader($file));
		}
		catch(Exception $e)
		{
			return App::abort(404, $e);
		}
	}

	public function assetsTheme($theme, $file)
	{
		try
		{
			$web = app('asmoyo.web');
			$content = file_get_contents(public_path( 
				'themes/'. $web['web_publicTemplate'].'/'.$file
			));
			return Response::make($content)
				->header('Content-Type', $this->assetHeader($file));
		}
		catch(Exception $e)
		{
			return App::abort(404, $e);
		}
	}

	protected function assetHeader($file)
	{
		if( false !== strpos($file, 'css') )
		{
			return 'text/css';
		}
		elseif( false !== strpos($file, 'js') )
		{
			return 'text/javascript';
		}
		elseif( false !== strpos($file, 'font') )
		{
			return 'application/octet-stream';
		}
		elseif( false !== strpos($file, 'jpg') )
		{
			return 'image/jpg';
		}
		elseif( false !== strpos($file, 'jpeg') )
		{
			return 'image/jpeg';
		}
		elseif( false !== strpos($file, 'png') )
		{
			return 'image/png';
		}
		elseif( false !== strpos($file, 'gif') )
		{
			return 'image/gif';
		}
	}

}
