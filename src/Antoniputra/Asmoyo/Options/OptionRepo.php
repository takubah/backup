<?php namespace Antoniputra\Asmoyo\Options;

use Config, Cache;
use Antoniputra\Asmoyo\Cores\RepoBase;

class OptionRepo extends RepoBase implements OptionInterface
{
	
	public function __construct(Option $model)
	{
		$this->model 		= $model;
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function get($key=null)
	{
		$cacheKey		= 'asmoyo.web';

		// check cache
		if($cachedResult = $this->cacheGet($cacheKey))
		{
			return ( !$key ) ? $cachedResult : $cachedResult[$key];
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
		$cachedResult = $this->cacheStore($cacheKey, $result);
		
		return ( !$key ) ? $cachedResult : $cachedResult[$key];
	}

	public function dateFormatList()
	{
		return array(
			'l, jS F Y - H:i A'	=> date('l, jS F Y - H:i A'),
			'l, j/F/Y - H:i A'	=> date('l, j/F/Y - H:i A'),
			'D, j/F/Y - H:i A'	=> date('D, j/F/Y - H:i A'),
			'j/F/Y - H:i A'		=> date('j/F/Y - H:i A'),
			'd-m-Y - H:i A'		=> date('d-m-Y - H:i A'),
		);
	}
}