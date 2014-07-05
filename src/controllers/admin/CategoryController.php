<?php

use Antoniputra\Asmoyo\Categories\CategoryInterface;

class Admin_CategoryController extends AsmoyoController
{
	public function __construct(CategoryInterface $category)
	{
		$this->category = $category;
	}

	public function index()
	{
		$data = array(
			'categories'	=> $this->category->getAllPaginated(),
		);
		
		return $this->loadView('asmoyo::admin.category.index', $data, true);
	}

	public function create()
	{
		$data = array();
		return $this->loadView('asmoyo::admin.category.create', $data);
	}

	public function store()
	{
		return 'here is store method';
	}

	public function show($slug)
	{
		$data = array(
			'category'		=> $this->category->getBySlug($slug),
		);

		if( ! $data['category'] ) return App::abort(404);

		return 'here is show method';
	}

	public function edit($slug)
	{
		$data = array(
			'category'		=> $this->category->getBySlug($slug),
		);

		if( ! $data['category'] ) return App::abort(404);

		return $this->loadView('asmoyo::admin.category.edit', $data);
	}

	public function update($slug)
	{
		$data = array(
			'category'		=> $this->category->getBySlug($slug),
		);

		if( ! $data['category'] ) return App::abort(404);

		return 'here is update method';
	}

	public function destroy($id)
	{
		return 'ini adalah method destroy';
	}
}