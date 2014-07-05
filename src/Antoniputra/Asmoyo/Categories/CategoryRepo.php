<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\RepoBase;

class CategoryRepo extends RepoBase implements CategoryInterface
{
	
	public function __construct(Category $model)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getAll($sortir = null, $limit = null)
	{
		return $this->prepareData($sortir, $limit)->with('cover')
			->paginate( $this->repoLimit($limit) );
	}

	public function getAllWithPosts($page = null, $limit = null)
	{
		return $this->prepareData($sortir, $limit)->with('cover', 'posts')
			->paginate( $this->repoLimit($limit) );
	}
	
	public function getAllPaginated($sortir = null, $limit = null)
	{
		return $this->prepareData()->with('cover')
			->paginate( $this->repoLimit($limit) );
	}

	public function getAllPaginatedWithPosts($page = null, $limit = null)
	{
		return $this->prepareData()->with('cover', 'posts')
			->paginate( $this->repoLimit($limit) );
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

}