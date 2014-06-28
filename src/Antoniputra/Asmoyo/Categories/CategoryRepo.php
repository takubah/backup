<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\RepoBase;

class CategoryRepo extends RepoBase implements CategoryInterface
{
	
	public function __construct(Category $model)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getCategories($limit=null)
	{
		return $this->prepareData()->with('posts')
			->where('type', 'category')
			->paginate( $this->repoLimit($limit) );
	}

	public function getCategoryById($id)
	{
		return $this->model->with('cover')
			->where('id', $id)
			->where('type', 'category')
			->first();
	}

	public function getCategoryBySlug($slug)
	{
		return $this->model->with('cover')
			->where('slug', $slug)
			->where('type', 'category')
			->first();
	}


	public function getGalleries($limit=null)
	{
		return $this->prepareData()->with('medias')
			->where('type', 'gallery')
			->paginate( $this->repoLimit($limit) );
	}

	public function getGalleryById($id)
	{
		return $this->model->with('cover')
			->where('id', $id)
			->where('type', 'gallery')
			->first();
	}

	public function getGalleryBySlug($slug)
	{
		return $this->model->with('cover')
			->where('slug', $slug)
			->where('type', 'gallery')
			->first();
	}

}