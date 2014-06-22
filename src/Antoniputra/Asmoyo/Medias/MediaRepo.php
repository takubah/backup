<?php namespace Antoniputra\Asmoyo\Medias;

use Antoniputra\Asmoyo\Cores\RepoBase;

class MediaRepo extends RepoBase {
	
	public function __construct(Media $model)
	{
		$this->model = $model;
	}

}