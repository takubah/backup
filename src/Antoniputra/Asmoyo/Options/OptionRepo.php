<?php namespace Antoniputra\Asmoyo\Options;

use Config, Cache, Input;
use Antoniputra\Asmoyo\Cores\RepoBase;

class OptionRepo extends RepoBase implements OptionInterface
{
	
	public function __construct(Option $model)
	{
		$this->model = $model;
	}


	protected function getCacheTag($key = 'one')
	{
		$one 	= $this->model->getTable() .'_oneData';
		$many 	= $this->model->getTable();
		$tags 	= array(
			'one'	=> $one,
			'many'	=> $many,
			'both'	=> array($one, $many),
		);

		if( ! isset($tags[$key]) )
			throw new \Exception($key ." Key not available", 1);

		return $tags[$key];
	}

	public function get($name=null)
	{
		// check cache
		$key = 'asmoyo.web';
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = array();
		foreach( $this->model->all() as $opt )
		{
			$result[$opt['name']]	= $opt['value'];
		}

		// save cache
		if($result) $this->cacheTag($tag)->forever($key, $result);
		return ( !$name ) ? $result : $result[$name];
	}

	public function update($attr=null)
	{
		$attr = $attr ?: Input::all();
		if($attr)
		{
			foreach($attr as $key => $val)
			{
				if(!empty($val))
				{
					$val = is_array($val) ? json_encode($val) : $val;
					$this->model->where('name', $key)->update(array('value' => $val));
				}
			}

			// forget cache
			$this->cacheTag( $this->getCacheTag('many') )->forget('asmoyo.web');
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