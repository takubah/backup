<?php

use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class AsmoyoController extends Controller {

	public function loadView($content, $data = array() )
	{
		$view = View::make('asmoyo::admin.oneCollumn', $data)->nest('content', $content, $data);
		return Pseudo::render($view);
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
			$header = 'text/css';
		} elseif( false !== strpos($file, 'js') ) {
			$header = 'text/javascript';
		}

		return $header;
	}

}
