<?php namespace Antoniputra\Asmoyo\Pages;

use Antoniputra\Asmoyo\Cores\RepoBase;

class PageRepo extends RepoBase {
	
	public function __construct(Page $model)
	{
		$this->model = $model;
	}

}