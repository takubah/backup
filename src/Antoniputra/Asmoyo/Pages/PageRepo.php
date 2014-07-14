<?php namespace Antoniputra\Asmoyo\Pages;

use Closure, Config, Cache;
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
		// check cache
		$key = __FUNCTION__.'|id:'.$id;
		if( $get = $this->cacheTag(__CLASS__)->get($key) ) return $get;

		$result = $this->model->find($id);

		// save cache
		$this->cacheTag(__CLASS__)->forever($key, $result);
		return $result;
	}

	public function getBySlug($slug)
	{
		// check cache
		$key = __FUNCTION__.'|slug:'.$slug;
		if( $get = $this->cacheTag(__CLASS__)->get($key) ) return $get;

		$result = $this->model->where('slug', $slug)->first();
		
		// save cache
		$this->cacheTag(__CLASS__)->forever($key, $result);
		return $result;
	}

	public function getAsMenu()
	{
		// check cache
		$key = __FUNCTION__;
		if( $get = $this->cacheTag(__CLASS__)->get($key) ) return $get;

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
		$this->cacheTag(__CLASS__)->forever($key, $result);
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
			$this->cacheFlush(__CLASS__);
			return true;
		}

		return false;
	}

	protected function getTypeList()
	{
		return array(
			'standard' 	=> 'Standard',
			'category' 	=> 'Category',
			'post'		=> 'Post',
		);
	}

	protected function getStructureList()
	{
		return array(
			'oneCollumn' 	=> 'One Collumn',
			'twoCollumn'	=> 'Two Collumn',
			'threeCollumn'	=> 'Three Collumn',
		);
	}
}