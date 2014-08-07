<?php namespace Antoniputra\Asmoyo\Galleries;

use Input, Str, Config;
use Antoniputra\Asmoyo\Cores\RepoBase;

class GalleryRepo extends RepoBase implements GalleryInterface
{
	protected $editRules = array(
		'title'		=> 'required|unique:galleries,title,<id>',
        'slug'		=> 'required|unique:galleries,slug,<id>',
        'file'		=> 'mimes:jpeg,jpg,gif,png'
	);
	
	public function __construct(Gallery $model)
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
			'items' => $this->prepareData($limit, $sortir, $status)->with('cover', 'medias')->get(),
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
		$result['items'] = $data->with('cover', 'medias')->skip( $limit * ($page-1) )
	                ->take($limit)
	                ->get();

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function getById($id)
	{
		// check cache
		$key = __FUNCTION__.'|id:'.$id;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag( $tag )->get($key) ) return $get;

		$result = $this->model->with('cover', 'medias')->find($id);

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

		$result = $this->model->with('cover', 'medias')
			->where('slug', $slug)
			->first();
		
		// save cache
		if($result) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

}