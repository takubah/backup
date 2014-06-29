<?php namespace Antoniputra\Asmoyo\Galleries;

use Antoniputra\Asmoyo\Cores\RepoBase;

class GalleryRepo extends RepoBase implements GalleryInterface
{
	
	public function __construct(Gallery $model)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getAll($limit=null)
	{
		return $this->prepareData()->with('cover', 'medias')
			->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		return $this->model->with('cover', 'medias')->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->with('cover', 'medias')
			->where('slug', $slug)
			->first();
	}

}