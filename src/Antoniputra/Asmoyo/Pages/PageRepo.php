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
		parent::__construct($model);
	}

	public function getAll($sortir = null, $limit = null, $status = null)
	{
		$status = $status ?: Input::get('status');
		$result = $this->model->orderBy('order', 'asc');
		if($status)
			$result = $result->where('status', $status);

		return $result->get();
	}

	public function getAllPaginated($sortir = null, $limit = null, $status = null)
	{
		$status = $status ?: Input::get('status');
		$result = $this->model->orderBy('order', 'asc');
		if($status)
			$result = $result->where('status', $status);

		return $result->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		// check cache
		$key = __FUNCTION__.'|id:'.$id;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag( $tag )->get($key) ) return $get;

		$result = $this->model->find($id);

		// save cache
		$this->cacheTag( $tag )->forever($key, $result);
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
		$this->cacheTag($tag)->forever($key, $result);
		return $result;
	}

	public function getAsMenu()
	{
		// check cache
		$key = __FUNCTION__;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

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

		// save cache
		$this->cacheTag($tag)->forever($key, $result);
		return $result;
	}

	private function childPage($parent_id)
	{
		return $this->model->where('parent_id', $parent_id)
			->get()->toArray();
	}

	public function store($input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		if($this->repoValidation($input))
		{
			$this->cacheFlush( $this->getCacheTag('many') );
			return $this->model->create($input);
		}

		return false;
	}

	public function update($id, $input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		$rules = array_merge($this->editRules, $rules);
		if($this->repoValidation($input, $rules))
		{
			$this->model->find($id)->update($input);
			$this->cacheFlush( $this->getCacheTag('both') );
			return true;
		}

		return false;
	}

	public function delete($id, $is_permanent=false)
	{
		if( $data = $this->model->find($id) )
		{
			if($is_permanent)
				$data->forceDelete();
			else
				$data->delete();

			$this->cacheFlush( $this->getCacheTag('both') );
			return true;
		}
		return false;
	}

	public function getCacheTag($key = 'one')
	{
		$one 	= __CLASS__ .'_oneData';
		$many 	= __CLASS__ .'_manyData';

		$tags 	= array(
			'one'	=> $one,
			'many'	=> $many,
			'both'	=> array($one, $many),
		);

		if( ! isset($tags[$key]) )
			throw new \Exception($key ." Key not available", 1);

		return $tags[$key];
	}

	public function getStatusList()
	{
		return array(
			'published'	=> 'Published',
			'privated'	=> 'Privated',
			// 'drafted'	=> 'Drafted'
		);
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