<?php namespace Antoniputra\Asmoyo\Medias;

// use Closure;
use Antoniputra\Asmoyo\Cores\RepoBase;

class MediaRepo extends RepoBase implements MediaInterface
{
		
	public function __construct(Media $model)
	{
		parent::__construct($model);
		$this->model = $model;
	}

	public function getAll($sortir = null, $limit = null)
	{
		return $this->prepareData($sortir, $limit)->get();
	}

	public function getAllPaginated($sortir = null, $limit = null)
	{
		return $this->prepareData($sortir, $limit)
			->paginate( $this->repoLimit($limit) );
	}

	public function getByGallery($gallery_id, $sortir = null, $limit = null)
	{
		return $this->prepareData($sortir, $limit)
			->where('category_id', $gallery_id)
			->paginate( $this->repoLimit($limit) );
	}

	public function getByType($type = 'internal', $sortir = null, $limit = null)
	{
		$type = (in_array( $type, $this->model->typeList )) ? $type : 'internal';

		return $this->prepareData($sortir, $limit)
			->where('type', $type)
			->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		return $this->model->with('category')->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->with('category')
			->where('slug', $slug)->first();
	}

}