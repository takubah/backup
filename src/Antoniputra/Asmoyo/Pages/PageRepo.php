<?php namespace Antoniputra\Asmoyo\Pages;

use Closure, Config, Cache, Input;
use Antoniputra\Asmoyo\Cores\RepoBase;

class PageRepo extends RepoBase implements PageInterface
{
	protected $editRules = array(
		'title'		=> 'required|unique:pages,title,<id>',
        'slug'		=> 'required|unique:pages,slug,<id>',
	);

	public function __construct(Page $model)
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
			'items' => $this->prepareData($limit, $sortir, $status)->get(),
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
		$result['items'] = $data->skip( $limit * ($page-1) )
	                ->take($limit)
	                ->get();

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function getById($id)
	{
		// check cache
		$key = __FUNCTION__.'|id:'.$id;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag( $tag )->get($key) ) return $get;

		$result = $this->model->find($id);

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

		$result = $this->model->where('slug', $slug)->first();
		
		// save cache
		if($result) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function getAsMenu()
	{
		// check cache
		$key = __FUNCTION__;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result 	= array();
		$pageParent = $this->getParent();

		if ($pageParent)
		{
			foreach ($pageParent as $p)
			{
				$p 				= $p;
				$p['child']		= $this->getChild($p['id']);
				$result[] = $p;
			}
		}

		// save cache
		if($result) $this->cacheTag($tag)->forever($key, $result);
		return $result;
	}

	public function getParent($toForm=false, $forgetId=false)
	{
		$parent = $this->model->select(array('id', 'parent_id', 'status', 'type', 'order', 'title', 'slug'))
					->where('parent_id', 0)
					->where('status', 'published')
					->orderBy('order','asc');

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
		return $this->model->select(array('id', 'parent_id', 'status', 'type', 'order', 'title', 'slug'))
			->where('parent_id', $parent_id)
			->where('status', 'published')
			->orderBy('order','asc')
			->get()->toArray();
	}

	public function updateMenu($data_json)
	{
		if($data_json)
		{
			foreach ($data_json[0] as $order => $parent)
			{
				if( isset($parent['children']) )
				{
					$this->model->where('id', $parent['id'])->update(array('order' => $order));
					foreach ($parent['children'][0] as $order => $child)
					{
						$this->model->where('id', $child['id'])->update(array('parent_id' => $parent['id'], 'order' => $order));
					}
				} else {
					$data = array('order' => $order);
					
					// handle if change child to parent
					if(isset($parent['setparent'])) $data = array_merge($data, array('parent_id' => $parent['setparent']));
					$this->model->where('id', $parent['id'])->update($data);
				}
			}
		}
		// reset cache
		$this->cacheFlush($this->getCacheTag('many'));
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

	public function getTypeList()
	{
		return array(
			'standard' 	=> 'Standard',
			'category' 	=> 'Category',
			'post'		=> 'Post',
		);
	}

	public function getStructureList($type='public')
	{
		$structure = array(
			'oneCollumn' 	=> 'One Collumn',
			'twoCollumn'	=> 'Two Collumn',
			'threeCollumn'	=> 'Three Collumn',
			'fourCollumn'	=> 'Four Collumn',
		);
		
		$web = app('asmoyo.web');
		$theme = ($type == 'public') ? $web['web_publicTemplate'] : $web['web_adminTemplate'] ;
		foreach ($theme['info']['structure'] as $value) {
			$result[$value]	= $structure[$value];
		}
		return $result;
	}
}