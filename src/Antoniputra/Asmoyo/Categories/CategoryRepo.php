<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\RepoBase;

class CategoryRepo extends RepoBase implements CategoryInterface
{
	protected $editRules = array(
		'title'		=> 'required|unique:categories,title,<id>',
        'slug'		=> 'required|unique:categories,slug,<id>',
	);

	public function __construct(Category $model)
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

	public function getAll($limit = null, $sortir = null, $status = null)
	{
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = array(
			'limit' => $limit,
			'sortir' => $sortir,
			'status' => $status,
			'items' => $this->prepareData($limit, $sortir, $status)
					->with('cover')
					->get(),
		);

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);
        return $result;
	}

	public function getAllWithPosts($limit = null, $sortir = null, $status = null)
	{
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = array(
			'limit' => $limit,
			'sortir' => $sortir,
			'status' => $status,
			'items' => $this->prepareData($limit, $sortir, $status)
					->with('cover', 'posts')
					->get(),
		);

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);
        return $result;
	}
	
	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null)
	{
		$page 	= $this->repoPage($page);
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|page:'.$page .'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$data 	= $this->prepareData($limit, $sortir, $status);
		$result = array(
			'total'	=> $data->count(),
			'page' 	=> $page,
			'limit'	=> $limit,
			'sortir' => $sortir,
			'status' => $status,
		);
		$result['items'] = $data->with('cover')->skip( $limit * ($page-1) )
	                ->take($limit)
	                ->get();

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function getAllPaginatedWithPosts($page = null, $limit = null, $sortir = null, $status = null)
	{
		$page 	= $this->repoPage($page);
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|page:'.$page .'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$data 	= $this->prepareData($limit, $sortir, $status);
		$result = array(
			'total'	=> $data->count(),
			'page' 	=> $page,
			'limit'	=> $limit,
			'sortir' => $sortir,
			'status' => $status,
		);
		$result['items'] = $data->with('cover', 'post')
					->skip( $limit * ($page-1) )
	                ->take($limit)
	                ->get();

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function getById($id)
	{
		return $this->model->with('cover')
			->find($id);
	}

	public function getByIdWithPosts($id)
	{
		return $this->model->with('cover', 'posts')
			->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->with('cover')
			->where('slug', $slug)
			->first();
	}

	public function getBySlugWithPosts($slug)
	{
		return $this->model->with('cover', 'posts')
			->where('slug', $slug)
			->first();
	}

	public function store($input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		if($this->repoValidation($input, $rules))
		{
			return $this->model->create($input);
		}

		return false;
	}

	public function update($id, $input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		if($this->repoValidation( $input, array_merge($this->editRules, $rules) ))
		{
			$prevData = $this->model->find($id);

			$this->cacheTag( $this->getCacheTag('one') )->forget('getById|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getByIdWithPosts|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getBySlug|slug:'.$prevData['slug']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getBySlugWithPosts|slug:'.$prevData['slug']);

			$prevData->update($input);
			return true;
		}
		return false;
	}

	public function getAsDropdown()
	{
		$data = $this->model->get();
		$result = array();
		foreach ($data as $d) {
			$result[$d['id']] = $d['title'];
		}
		return $result;
	}

	public function getStructure($limit = null, $sortir = null, $status = null)
	{
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result 	= array();
		$catParent 	= $this->prepareData($limit, $sortir, $status)->where('parent_id', 0)->get()->toArray();

		if ($catParent)
		{
			foreach ($catParent as $c)
			{
				$c 			= $c;
				$c['child']	= $this->model->where('parent_id', $c['id'])->where('status', 'published')->get()->toArray();
				$result[] 	= $c;
			}
		}

		// save cache
		if($result) $this->cacheTag($tag)->forever($key, $result);
		return $result;
	}

	public function getParent($toForm=false, $forgetId=false)
	{
		$parent = $this->model->where('parent_id', 0)->where('status', 'published');

		if($forgetId) {
			$parent = $parent->where('id', '!=', $forgetId);
		}

		$parent = $parent->get()->toArray();

		if($toForm)
		{
			$result = array(0 => 'Tidak ada');
			foreach ($parent as $p)	{
				$result[$p['id']] = $p['title'];
			}
			return $result;
		}

		return $parent;
	}

	public function getChild($parent_id)
	{
		return $this->model->where('parent_id', $parent_id)
			->where('status', 'published')
			->get()->toArray();
	}

	public function delete($id, $is_permanent=false)
	{
		if( $prevData = $this->model->find($id) )
		{
			$this->cacheTag( $this->getCacheTag('one') )->forget('getById|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getByIdWithPosts|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getBySlug|slug:'.$prevData['slug']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getBySlugWithPosts|slug:'.$prevData['slug']);

			if($is_permanent)
				$prevData->forceDelete();
			else
				$prevData->delete();

			return true;
		}
		return false;
	}

}