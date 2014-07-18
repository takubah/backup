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
		$cats = $this->category->getAllPaginated();
		$data = array(
			'categories'	=> Paginator::make($cats, $cats['total'], $cats['limit']),
		);
		
		return $this->loadView('asmoyo::admin.category.index', $data, true);
	}

	public function create()
	{
		$data = array(
			'parentList'	=> $this->category->getParent(true),
			'statusList'	=> $this->category->getStatusList(),
		);
		return $this->loadView('asmoyo::admin.category.create', $data);
	}

	public function store()
	{
		$input = Input::all();

		if ( $this->category->store($input) )
		{
			return $this->redirectAlert('admin.category.index', 'success', 'Berhasil !!');
		}

		return $this->redirectAlert(false, 'danger', 'Gagal !!', $this->category->errors);
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
		$category 	= $this->category->getBySlug($slug);
		$data 		= array(
			'category'		=> $category,
			'parentList'	=> $this->category->getParent(true, $category['id']),
			'statusList'	=> $this->category->getStatusList(),
		);

		if( ! $data['category'] ) return App::abort(404);

		return $this->loadView('asmoyo::admin.category.edit', $data);
	}

	public function update($slug)
	{
		$input = Input::all();
		$rules = array();

		if ( $this->category->update( $input['id'], $input, $rules ) )
		{
			return $this->redirectAlert('admin.category.index', 'success', 'Berhasil Diperbarui !!');
		}

		return $this->redirectAlert(false, 'danger', 'Gagal !!', $this->category->errors);
	}

	public function destroy($id)
	{
		if( $this->category->delete($id) )
		{
			return $this->redirectAlert('admin.category.index', 'success', 'Berhasil Dihapus !!');
		}
		return $this->redirectAlert(false, 'danger', 'Gagal Dihapus !!');
	}

	public function forceDelete($id)
	{
		if( $this->category->delete($id, true) )
		{
			return $this->redirectAlert('admin.category.index', 'success', 'Berhasil Dihapus Permanent !!');
		}
		return $this->redirectAlert(false, 'danger', 'Gagal Dihapus Permanent !!');
	}
}