<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\RepoBase;

class CategoryRepo extends RepoBase {
	
	public function __construct(Category $model)
	{
		$this->model = $model;
	}

}