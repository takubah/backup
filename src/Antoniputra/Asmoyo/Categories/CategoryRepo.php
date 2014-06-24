<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\RepoBase;

class CategoryRepo extends RepoBase {
	
	public function __construct(Category $model)
	{
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