<?php namespace Antoniputra\Asmoyo\Options;

use Config, Cache, Input;
use Antoniputra\Asmoyo\Cores\RepoBase;

class OptionRepo extends RepoBase implements OptionInterface
{
	
	public function __construct(Option $model)
	{
		parent::__construct($model);
	}

	public function get($name=null)
	{
		// check cache
		$key = 'asmoyo.web';
		if( $get = $this->cacheTag(__CLASS__)->get($key) ) return $get;

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

		// save cache
		$this->cacheTag(__CLASS__)->forever($key, $result);
		
		return ( !$name ) ? $result : $result[$name];
	}

	public function update($attr=null)
	{
		$attr = $attr ?: Input::all();
		if($attr)
		{
			foreach($attr as $key => $val)
			{
				if(is_array($val) AND !empty($val))
				{
					$this->model->where('name', $key)->update(array('value' => json_encode($val)));
				} else {
					$this->model->where('name', $key)->update(array('value' => $val));
				}
			}

			// forget cache
			$this->cacheFlush(__CLASS__);
			return true;
		}

		return false;
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