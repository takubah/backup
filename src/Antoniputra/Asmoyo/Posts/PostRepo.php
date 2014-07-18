<?php namespace Antoniputra\Asmoyo\Posts;

use Closure, Config, Cache, Input;
use Antoniputra\Asmoyo\Cores\RepoBase;

class PostRepo extends RepoBase implements PostInterface
{
	protected $editRules = array(
		'title'		=> 'required|unique:posts,title,<id>',
        'slug'		=> 'required|unique:posts,slug,<id>',
	);

	public function __construct(Post $model)
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
			'items' => $this->prepareData($limit, $sortir, $status)->with('groupable', 'cover')->get(),
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

		$data 	= $this->prepareData($limit, $sortir, $status)->with('groupable', 'cover');
		$result = array(
			'total'	=> $data->count(),
			'page' 	=> $page,
			'limit'	=> $limit,
			'sortir' => $sortir,
			'status' => $status,
		);
		$result['items'] = $data->skip( $limit * ($page-1) )
	                ->take($limit)
	                ->get();

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function getByType($type='article', $limit=null)
	{
		$type = (in_array( $type, $this->model->typeList )) ? $type : 'article';

		return $this->prepareData()->with('groupable', 'cover')
			->where('type', $type)
			->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		// check cache
		$key = __FUNCTION__.'|id:'.$id;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag( $tag )->get($key) ) return $get;

		$result = $this->model->with('groupable', 'cover')->find($id);

		// save cache
		if($result) $this->cacheTag( $tag )->forever($key, $result);

		return $result;
	}

	public function getBySlug($slug)
	{
		// check cache
		$key = __FUNCTION__.'|slug:'.$slug;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = $this->model->with('groupable', 'cover')->where('slug', $slug)->first();
		
		// save cache
		if($result) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function store($input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		$input['type'] 		= isset($input['type']) ? $input['type'] : 'article';
		$input['user_id'] 	= \Auth::user()->id;
		$input['groupable_id'] 	= $input['groupable']['id'];
		$input['groupable_type'] = $input['groupable']['type'];
		
		if($this->repoValidation($input, $rules))
		{
			return $this->model->create($input);
		}
		return false;
	}

	public function update($id, $input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		$input['type'] 		= isset($input['type']) ? $input['type'] : 'article';
		$input['user_id'] 	= \Auth::user()->id;
		$input['groupable_id'] 	= $input['groupable']['id'];
		$input['groupable_type'] = $input['groupable']['type'];

		if($this->repoValidation( $input, array_merge($this->editRules, $rules) ))
		{
			$prevData = $this->model->find($id);

			$this->cacheTag( $this->getCacheTag('one') )->forget('getById|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getBySlug|slug:'.$prevData['slug']);

			$prevData->update($input);
			return true;
		}

		return false;
	}

	public function delete($id, $is_permanent=false)
	{
		if( $prevData = $this->model->find($id) )
		{
			$this->cacheTag( $this->getCacheTag('one') )->forget('getById|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getBySlug|slug:'.$prevData['slug']);

			if($is_permanent)
				$prevData->forceDelete();
			else
				$prevData->delete();

			return true;
		}
		return false;
	}

}