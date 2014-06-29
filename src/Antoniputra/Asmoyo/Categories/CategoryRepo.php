<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\RepoBase;

class CategoryRepo extends RepoBase implements CategoryInterface
{
	
	public function __construct(Category $model)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getAll($limit=null)
	{
		return $this->prepareData()->with('cover', 'posts')
			->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		return $this->model->with('cover', 'posts')
			->where('id', $id)
			->first();
	}

	public function getBySlug($slug)
	{
		return $this->model->with('cover', 'posts')
			->where('slug', $slug)
			->first();
	}

}