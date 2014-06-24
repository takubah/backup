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

	public function getAll($limit=null)
	{
		return $this->prepareData()
			->paginate( $this->repoLimit($limit) );
	}

	public function getByGallery($gallery_id, $limit=null)
	{
		return $this->prepareData()
			->where('category_id', $gallery_id)
			->paginate( $this->repoLimit($limit) );
	}

	public function getByType($type='internal', $limit=null)
	{
		$type = (in_array( $type, $this->model->typeList )) ? $type : 'internal';

		return $this->prepareData()
			->where('type', $type)
			->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		return $this->model->with('category')->find($id);
	}

}