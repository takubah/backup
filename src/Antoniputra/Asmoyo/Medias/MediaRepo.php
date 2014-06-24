<?php namespace Antoniputra\Asmoyo\Medias;

use Antoniputra\Asmoyo\Cores\RepoBase;

class MediaRepo extends RepoBase implements MediaInterface
{
	
	public function __construct(Media $model)
	{
		$this->model = $model;
	}

	public function getByGallery($gallery_id)
	{
		// $this->model->
	}

	public function getByType($type)
	{

	}

}