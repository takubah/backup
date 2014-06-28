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
		return $this->prepareData()->postCategory()
			->paginate( $this->repoLimit($limit) );
	}

	public function getByType($type='article', $limit=null)
	{
		$type = (in_array( $type, $this->model->typeList )) ? $type : 'article';

		return $this->prepareData()
			->where('type', $type)
			->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		$post 	= $this->model->find($id);
		$result = $post->toArray();
		$result['groupable']	= $post->groupable->toArray();

		return $result;
	}

	public function getBySlug($slug)
	{
		$post 	= $this->model->where('slug', $slug)->first();
		$result = $post->toArray();
		$result['groupable']	= $post->groupable->toArray();

		return $result;
	}

}