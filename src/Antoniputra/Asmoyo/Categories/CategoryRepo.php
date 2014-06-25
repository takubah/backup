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

	}

	public function getCategoryById()
	{

	}

	public function getCategoryBySlug()
	{

	}


	public function getGalleries($limit=null)
	{

	}

	public function getGaleryById()
	{

	}

	public function getGaleryBySlug()
	{

	}

}