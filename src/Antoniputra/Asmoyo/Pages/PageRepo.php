<?php namespace Antoniputra\Asmoyo\Pages;

use Antoniputra\Asmoyo\Cores\RepoBase;

class PageRepo extends RepoBase implements PageInterface
{
	
	public function __construct(Page $model)
	{
		parent::__construct($model);
		$this->model = $model;
	}

	public function getAll($limit=null)
	{
		return $this->model->orderBy('order', 'asc')->get();
	}

	public function getById($id)
	{
		return $this->model->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->where('slug', $slug)->first();
	}

}