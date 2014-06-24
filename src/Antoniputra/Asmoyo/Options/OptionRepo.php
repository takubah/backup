<?php namespace Antoniputra\Asmoyo\Options;

use Config, Cache;
use Antoniputra\Asmoyo\Cores\RepoBase;

class OptionRepo extends RepoBase {
	
	public function __construct(Option $model)
	{
		$this->model = $model;
	}

	public function get($key=null)
	{
		$cacheBaseKey	= Config::get('asmoyo::config.cache.baseName');
		$cacheKey		= 'asmoyo.web';

		// check cache
		if( Cache::tags( $cacheBaseKey )->has($cacheKey) )
		{
			$optionCached = Cache::tags( $cacheBaseKey )->get($cacheKey);

			return ( !$key ) ? $optionCached : $optionCached[$key];
		}

		$result = array();
		foreach( \Antoniputra\Asmoyo\Options\Option::all() as $opt )
		{
			if($opt['type'] == 'json')
			{
				$result[$opt['name']]	= json_decode($opt['value'], true);
			} else {
				$result[$opt['name']]	= $opt['value'];
			}
		}

		// save item to cache
		$optionData	= Cache::tags( $cacheBaseKey )->rememberForever($cacheKey, function() use ($result)
		{
			return $result;
		});
		
		return ( !$key ) ? $optionData : $optionData[$key];
	}
}