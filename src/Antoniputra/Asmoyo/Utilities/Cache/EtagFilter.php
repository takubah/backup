<?php namespace Antoniputra\Asmoyo\Utilities\Cache;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Config;

class EtagFilter {
	
	public function get(Route $route, Request $request)
	{

	}

	public function set(Route $route, Request $request, Response $response)
	{

	}

	protected function makeKey($url)
	{
		$web = app('asmoyo.web');
		public_path('packages/antoniputra/asmoyo/'. $web['web_adminTemplate'].'/'.$file);

		return 
	}
}