<?php namespace Antoniputra\Asmoyo\Cores;

use Lang, Input, Validator, Config, Cache;

abstract class RepoBase
{
	public $model;

	public $errors;

	public function __construct($model=null)
	{
		$this->model      = $model;
	}

	public function cacheTag($tag)
	{
		$baseTag 	= Config::get('asmoyo::cache.base_name');
		if( is_array($tag) )
		{
			foreach ($tag as $value) {
				$tag[]	= $baseTag.'.'.$value;
			}
			$tag = array_merge(array($baseTag), $tag);
		} else {
			$tag 	= $baseTag.'.'.$tag;
			$tag 	= array($baseTag, $tag);
		}
		return Cache::tags($tag);
	}

	public function cacheFlush($tag)
	{
		$baseTag 	= Config::get('asmoyo::cache.base_name');
		$tag 		= $baseTag.'.'.$tag;
		return Cache::tags($tag)->flush();
	}

	protected function repoValidation($input, $custom_rules=array())
	{
		$rules = $this->prepareValidation( $input, array_merge($this->model->defaultRules(), $custom_rules) );

		$messages   = Lang::get('validation.custom');
		$v          = Validator::make($input, $rules, $messages);
		
		 // check for failure
		if ($v->fails())
		{
			// set errors and return false
			$this->errors = $v->messages()->all();
			return false;
		}

		return true;
	}

	private function prepareValidation($input, $rules)
	{
		$preparedRules = array();

		foreach ($rules as $key => $rule)
		{
			if (false !== strpos($rule, "<id>"))
			{
				$rule = str_replace("<id>", $input['id'], $rule);
			}
			elseif (false !== strpos($rule, "<slug>"))
			{
				$rule = str_replace("<slug>", $input['slug'], $rule);
			}

			$preparedRules[$key] = $rule;
		}

		return $preparedRules;
	}


	protected function prepareData($sortir = null, $limit = null, $status = null)
	{
		$data = $this->model;

		$sortir = $sortir ?: Input::get('sortir');
		$limit  = $limit ?: Input::get('limit');
		$status = $status ?: Input::get('status');
		
		switch ( $sortir ) {
			case 'new':
				$data = $data->orderBy('created_at', 'desc');
			break;
			
			case 'latest-updated':
				$data = $data->orderBy('updated_at', 'desc');
			break;

			case 'title-ascending':
				$data = $data->orderBy('title', 'asc');
			break;

			case 'title-descending':
				$data = $data->orderBy('title', 'desc');
			break;

			case 'popular':
				$data = $data->orderBy('title', 'desc');
			break;
			
			default:
				// default by new
				$data = $data->orderBy('created_at', 'desc');
			break;
		}

		switch ( $status ) {
			case 'published':
				$data = $data->where('status', 'published');
			break;

			case 'privated':
				$data = $data->where('status', 'privated');
			break;
			
			case 'drafted':
				$data = $data->where('status', 'drafted');
			break;
			
			case 'pending':
				$data = $data->where('status', 'pending');
			break;
			
			default:
				
			break;
		}

		$data = $data->limit( $this->repoLimit($limit) );

		return $data;
	}

	/**
	* Set global limit data for all object
	* @param $limit integer|numeric
	*/
	protected function repoLimit($limit=null)
	{
		$web = app('asmoyo.web');
		$limit = Input::get('limit', $limit) ?: $web['web_itemPerPage'];

		return is_numeric($limit) ? $limit : 10;
	}

	public function getSortirList()
	{
		return array(
			'new'               => 'new',
			'latest-updated'    => 'latest-updated',
			'title-ascending'   => 'title-ascending',
			'title-descending'  => 'title-descending',
			'popular'           => 'popular',
		);
	}

	public function watermarkPositionList()
	{
		return array(
			'top-left'      => 'top-left',
			'top'           => 'top',
			'top-right'     => 'top-right',
			'left'          => 'left',
			'center'        => 'center',
			'right'         => 'right',
			'bottom-left'   => 'bottom-left',
			'bottom'        => 'bottom',
			'bottom-right'  => 'bottom-right',
		);
	}

}