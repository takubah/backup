<?php namespace Antoniputra\Asmoyo\Utilities\Cache;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App, Config;

class EtagFilter {
	
	public function get(Route $route, Request $request)
	{
		$entity = $this->entity( $request->path() );

		if( $this->isValid( $entity, $request->getEtags() ) )
		{
			return App::abort(304);
		}
	}

	public function set(Route $route, Request $request, Response $response)
	{
		if( $entity = $this->entity( $request->path() ) )
		{
	 		$response->setEtag( md5($entity) );
		}
	}

	/**
	* get path to file, for get time modified file
	*/
	protected function entity($url)
	{
		$web = app('asmoyo.web');
		if( false !== strpos($url, 'assets') )
		{
			
			if( false !== strpos($url, 'themes') )
				$path = public_path( str_replace('assets', 'themes', $url) );			
			else
				$path = public_path( str_replace('assets/admin', 'packages/antoniputra/asmoyo/admin', $url) );

		}
		elseif( false !== strpos($url, 'uploads') )
		{
			$path_image = Config::get('asmoyo::config.uploads.path_image');
			$path 	= str_replace('uploads', $path_image, $url);
		}

		if( file_exists($path) )
		{
			return filemtime($path);
		}

		return false;
	}

	/**
	* check if between given key and last key valid
	* @param integer $entity (contain file time)
	* @param current Etags key
	*/
	private function isValid($entity, $etag)
	{
		$entity = md5($entity);
		$etag 	= str_replace('"', '', $etag);

		if ( isset($etag[0]) )
		{
			if ( $etag[0] === $entity )
	    	{
		        return true;
	    	}

	    	// etag gzip
	    	$e_gzip = $entity.'-gzip';
	    	
	    	if( $e_gzip === $etag[0] )
	    	{
	    		return true;
	    	}
    	}
	}
}