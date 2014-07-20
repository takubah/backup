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
		$baseTag = Config::get('asmoyo::cache.base_name');
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

	public function cacheFlush($tag, $is_reset_all=false)
	{
		$baseTag 	= Config::get('asmoyo::cache.base_name');
		if( is_array($tag) )
		{
			foreach ($tag as $value) {
				$tag[]	= $baseTag.'.'.$value;
			}
		} else {
			$tag 	= $baseTag.'.'.$tag;
			$tag 	= array($tag);
		}

		if ($is_reset_all) $tag = array_merge(array($baseTag), $tag);

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


	protected function prepareData($limit = null, $sortir = null, $status = null)
	{
		$data = $this->model;
		$sortir = $sortir ?: $this->repoSortir($sortir);
		$limit  = $limit ?: $this->repoLimit($limit);
		$status = $status ?: $this->repoStatus($status);

		if(is_array($sortir))
		{
			$data = $data->orderBy($sortir[0], $sortir[1]);
		} else {
			switch ($sortir)
			{
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
					// do nothing
				break;
			}
		}

		if(is_array($status))
		{
			$data = $data->where($status[0], $status[1]);
		} elseif( isset($this->model->getFillable()['status']) ) {
			switch ($status)
			{
				case 'all':
					$data = $data;
				break;

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
					// do nothing
				break;
			}
		}

		$data = $data->limit($limit);

		return $data;
	}

	/**
	* Set global page segment for all object
	* @param $page integer|numeric
	*/
	public function repoPage($page=null)
	{
		$web 	= app('asmoyo.web');
		$page 	= $page ?: Input::get('page');
		$result = is_numeric($page) ? $page : 1;
		return (integer) $result;
	}

	/**
	* Set global limit data for all object
	* @param $limit integer|numeric
	*/
	public function repoLimit($limit=null)
	{
		$web 	= app('asmoyo.web');
		$limit 	= $limit ?: Input::get('limit');
		$result = is_numeric($limit) ? $limit : $web['web_itemPerPage'];
		return (integer) $result;
	}

	/**
	* Set global sortir data for all object
	* @param $sortir integer|numeric
	*/
	public function repoSortir($sortir=null)
	{
		if(is_array($sortir)) return $sortir;

		$web 	= app('asmoyo.web');
		$sortir = $sortir ?: Input::get('sortir');

		return $sortir ?: $web['web_itemSortir'];
	}

	/**
	* Set global status for all object
	* @param $status integer|numeric
	*/
	public function repoStatus($status=null)
	{
		return $status ?: Input::get('status', 'all');
	}

	public function getStatusList()
	{
		return array(
			'published'	=> 'Published',
			'privated'	=> 'Privated',
			// 'drafted'	=> 'Drafted'
		);
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