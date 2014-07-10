<?php namespace Antoniputra\Asmoyo\Medias;

// use Closure;
use Input, Str, Config;
use Antoniputra\Asmoyo\Cores\RepoBase;
use Antoniputra\Asmoyo\Medias\Image;

class MediaRepo extends RepoBase implements MediaInterface
{
	public function __construct(Media $model)
	{
		parent::__construct($model);
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

	public function store()
	{
		$input = Input::all();
		$input['type'] = isset($input['type']) ? $input['type'] : 'internal';
		if($this->repoValidation($input))
		{
			$image = new Image;
			if( $img = $image->uploadImage($input) )
			{
				return $this->model->create(array(
					'title' 		=> $img['title'],
					'slug'	 		=> Str::slug($img['title']),
					'description'	=> Input::get('description', ''),
					'alt'			=> Input::get('alt', $img['title']),
					'type'			=> $input['type'],
					'file'			=> $img['fileName'],
					'mime_type'		=> $img['mimeType'],
					'extension'		=> $img['extension'],
					'size'			=> $img['size'],
				));
			}
		}
		return false;
	}
}