<?php namespace Antoniputra\Asmoyo\Pages;

use Closure, Config, Cache;
use Antoniputra\Asmoyo\Cores\RepoBase;

class PageRepo extends RepoBase implements PageInterface
{
	
	public function __construct(Page $model)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getAll($sortir = null, $limit = null)
	{
		return $this->model->orderBy('order', 'asc')->get();
	}

	public function getAllPaginated($sortir = null, $limit = null)
	{
		return $this->model->orderBy('order', 'asc')->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		return $this->model->find($id);
	}

	public function getBySlug($slug)
	{
		$cacheKey = __FUNCTION__.'|'.$slug;

		// check cache
		if($cachedResult = $this->cacheGet($cacheKey)) {
			return $cachedResult;
		}
		
		return $this->cacheStore( $cacheKey, $this->model->where('slug', $slug)->first() );
	}

	public function getAsMenu()
	{
		// check cache
		if($cachedResult = $this->cacheGet(__FUNCTION__)) {
			return $cachedResult;
		}

		$result 	= array();
		$pageParent = $this->model->where('parent_id', 0)->get()->toArray();
		
		if ($pageParent)
		{
			foreach ($pageParent as $p)
			{
				$p 				= $p;
				$p['dropdown']	= $this->childPage($p['id']);

				$result[]	= $p;
			}
		}

		return $this->cacheStore(__FUNCTION__, $result);
	}

	private function childPage($parent_id)
	{
		return $this->model->where('parent_id', $parent_id)
			->get()->toArray();
	}

}