<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\RepoBase;

class CategoryRepo extends RepoBase implements CategoryInterface
{
	
	public function __construct(Category $model)
	{
		parent::__construct($model);
		$this->model = $model;
	}

	public function getCategories($limit=null)
	{
		return $this->prepareData()
			->where('type', 'category')
			->paginate( $this->repoLimit($limit) );
	}

	public function getCategoryById($id)
	{
		return $this->model->with('cover')->find($id);
	}

	public function getCategoryBySlug($slug)
	{
		return $this->model->with('cover')
			->where('slug', $slug)
			->first();
	}


	public function getGalleries($limit=null)
	{
		return $this->prepareData()
			->where('type', 'gallery')
			->paginate( $this->repoLimit($limit) );
	}

	public function getGalleryById($id)
	{
		return $this->model->with('cover')
			->where('id', $id)
			->andWhere('type', 'gallery')
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