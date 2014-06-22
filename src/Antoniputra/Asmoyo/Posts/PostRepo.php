<?php namespace Antoniputra\Asmoyo\Posts;

use Antoniputra\Asmoyo\Cores\RepoBase;

class PostRepo extends RepoBase {
	
	public function __construct(Post $model)
	{
		$this->model = $model;
	}

}