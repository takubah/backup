<?php namespace Antoniputra\Asmoyo\Posts;

use Antoniputra\Asmoyo\Cores\RepoBase;

class PostRepo extends RepoBase implements PostInterface
{
	
	public function __construct(Post $model)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getAll($limit=null)
	{
		return $this->prepareData()->with('groupable', 'cover')->paginate( $this->repoLimit($limit) );
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
		return $this->model->with('groupable', 'cover')->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->with('groupable', 'cover')
			->where('slug', $slug)->first();
	}

}