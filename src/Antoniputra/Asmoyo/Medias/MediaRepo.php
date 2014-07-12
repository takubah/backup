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
		if($this->repoValidation($input))
		{
			$image = new Image;
			if( $img = $image->uploadImage($input) )
			{
				$title = Input::get('title', $img['title']);
				return $this->model->create(array(
					'title' 		=> $title,
					'slug'	 		=> Str::slug($title),
					'description'	=> Input::get('description', ''),
					'type'			=> $input['type'],
					'file'			=> $img['fileName'],
					'mime_type'		=> $img['mimeType'],
					'size'			=> $img['size'],
				));
			}
		}
		return false;
	}

	public function update($id)
	{
		$input = Input::all();
		if($this->repoValidation( $input, array('file' => 'mimes:jpeg,jpg,gif,png') ))
		{
			$data = array(
				'title' 		=> Input::get('title'),
				'slug'	 		=> Str::slug( Input::get('title') ),
				'description'	=> Input::get('description', ''),
				'type'			=> $input['type'],
			);

			if( Input::hasFile('file') )
			{
				$image = new Image;
				if( $img = $image->uploadImage($input, $input['fileName']) )
				{
					$imageData = array(
						'file'			=> $img['fileName'],
						'mime_type'		=> $img['mimeType'],
						'size'			=> $img['size'],
					);
					$data = array_merge($data, $imageData);
				}
			}
			
			return $this->model->where('id', $id)->update($data);
		}
		return false;
	}

	public function delete($id)
	{
		$media = $this->model->find($id);
		$image = new Image;

		// delete original img
    	$original = $image->path('original/'.$media['file']);
    	if( file_exists($original) ) unlink($original);

    	// delete small img
    	$small = $image->path('small/'.$media['file']);
    	if( file_exists($small) ) unlink($small);

    	// delete medium img
    	$medium = $image->path('medium/'.$media['file']);
    	if( file_exists($medium) ) unlink($medium);

    	// delete large img
    	$large = $image->path('large/'.$media['file']);
    	if( file_exists($large) ) unlink($large);

    	return $media->delete();
	}
}