<?php namespace Antoniputra\Asmoyo\Utilities\Cache;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Str, Cache, Config;

class CacheFilter {
	
	/**
	* Get Cache by key
	*/
	public function get(Route $route, Request $request)
	{
		$key = $this->makeKey( $request->url() );
		if( $this->cacheTags()->has($key) )
		{
			return $this->cacheTags()->get($key);
		}
	}

	/**
	* Set Cache by key
	*/
	public function set(Route $route, Request $request, Response $response)
	{
		$key = $this->makeKey( $request->url() );
		if( ! $this->cacheTags()->has($key) )
		{
			$cacheTime = Config::get('asmoyo::cache.time');
	        if( is_integer($cacheTime) )
	        {
				$this->cacheTags()->put($key, $response, $cacheTime);
			}
			else
			{
				$this->cacheTags()->forever($key, $response);
			}
		}
	}

	protected function cacheTags()
	{
		return Cache::tags(array(
			Config::get('asmoyo::cache.base_name'),
			Config::get('asmoyo::cache.base_name').'.assets',
		));
	}

	protected function makeKey($url = null)
	{
		return Str::slug( $url );
	}

}