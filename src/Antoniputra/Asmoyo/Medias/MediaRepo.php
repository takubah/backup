<?php namespace Antoniputra\Asmoyo\Medias;

// use Closure;
use Input, Str, Config;
use Antoniputra\Asmoyo\Cores\RepoBase;
use Antoniputra\Asmoyo\Medias\Image;

class MediaRepo extends RepoBase implements MediaInterface
{
	protected $editRules = array(
		'title'		=> 'required|unique:medias,title,<id>',
        'slug'		=> 'required|unique:medias,slug,<id>',
        'file'		=> 'mimes:jpeg,jpg,gif,png'
	);

	public function __construct(Media $model)
	{
		$this->model = $model;
	}

	protected function getCacheTag($key = 'one')
	{
		$one 	= $this->model->getTable() .'_oneData';
		$many 	= $this->model->getTable();
		$tags 	= array(
			'one'	=> $one,
			'many'	=> $many,
			'both'	=> array($one, $many),
		);

		if( ! isset($tags[$key]) )
			throw new \Exception($key ." Key not available", 1);

		return $tags[$key];
	}

	public function getAll($limit = null, $sortir = null, $status = null)
	{
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = array(
			'limit' => $limit,
			'sortir' => $sortir,
			'status' => $status,
			'items' => $this->prepareData($limit, $sortir, $status)->get(),
		);

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);
        return $result;
	}

	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null)
	{
		$page 	= $this->repoPage($page);
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|page:'.$page .'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$data 	= $this->prepareData($limit, $sortir, $status);
		$result = array(
			'total'	=> $data->count(),
			'page' 	=> $page,
			'limit'	=> $limit,
			'sortir' => $sortir,
			'status' => $status,
		);
		$result['items'] = $data->skip( $limit * ($page-1) )
	                ->take($limit)
	                ->get();

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function getByGallery($gallery_id, $sortir = null, $limit = null)
	{
		die( __FUNCTION__ .'comming sooon');

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
		// check cache
		$key = __FUNCTION__.'|id:'.$id;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag( $tag )->get($key) ) return $get;

		$result = $this->model->find($id);

		// save cache
		if($result) $this->cacheTag( $tag )->forever($key, $result);

		return $result;
	}

	public function getBySlug($slug)
	{
		// check cache
		$key = __FUNCTION__.'|slug:'.$slug;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = $this->model->where('slug', $slug)->first();
		
		// save cache
		if($result) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function store($input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		if($this->repoValidation($input, $rules))
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
					'status'		=> Input::get('status', 'published'),
				));
			}
			$this->errors = $this->image->errors;
		}
		return false;
	}

	public function update($id, $input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		if($this->repoValidation( $input, array_merge($this->editRules, $rules) ))
		{
			$data = array(
				'title' 		=> Input::get('title'),
				'slug'	 		=> Str::slug( Input::get('title') ),
				'description'	=> Input::get('description', ''),
				'type'			=> $input['type'],
				'status'		=> Input::get('status', 'published'),
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

			$prevData = $this->model->find($id);

			$this->cacheTag( $this->getCacheTag('one') )->forget('getById|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getBySlug|slug:'.$prevData['slug']);
			
			$prevData->update($data);
			return true;
		}
		return false;
	}

	public function delete($id)
	{
		if( $prevData = $this->model->find($id) )
		{
			$this->cacheTag( $this->getCacheTag('one') )->forget('getById|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getBySlug|slug:'.$prevData['slug']);

			$image = new Image;

			// delete original img
	    	$original = $image->path('original/'.$prevData['file']);
	    	if( file_exists($original) ) unlink($original);

	    	// delete small img
	    	$small = $image->path('small/'.$prevData['file']);
	    	if( file_exists($small) ) unlink($small);

	    	// delete medium img
	    	$medium = $image->path('medium/'.$prevData['file']);
	    	if( file_exists($medium) ) unlink($medium);

	    	// delete large img
	    	$large = $image->path('large/'.$prevData['file']);
	    	if( file_exists($large) ) unlink($large);

	    	return $prevData->delete();
    	}
    	return false;
	}
}