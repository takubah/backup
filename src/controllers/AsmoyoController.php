<?php

use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class AsmoyoController extends Controller {

	protected $viewStructure;

	public function setStructure($file, $type='public')
	{
		$theme = ($type == 'admin') ? app('asmoyo.web')['web_adminTemplate'] : app('asmoyo.web')['web_publicTemplate'] ;
		$this->viewStructure = 'asmoyoTheme.'. $theme .'.'. $file;
		return $this;
	}

	public function loadView($content, $data = array(), $disabledPseudo=false)
	{
		include __DIR__ . '/../composers.php';
		
		// set view structure if empty
		if(!$this->viewStructure) {
			$this->viewStructure = ( Request::segment(1) == 'admin' ) 
				? 'asmoyo::admin.twoCollumn'
				: 'asmoyoTheme.'. app('asmoyo.web')['web_publicTemplate'] .'.twoCollumn';
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
