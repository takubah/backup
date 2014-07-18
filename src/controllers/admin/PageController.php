<?php

use Antoniputra\Asmoyo\Pages\PageInterface;

class Admin_PageController extends AsmoyoController
{
	public function __construct(PageInterface $page)
	{
		$this->page = $page;
	}

	public function index()
	{
		$pages 	= $this->page->getAllPaginated();
		$data 	= array(
			'pages'		=> Paginator::make($pages, $pages['total'], $pages['limit']),
		);
		return $this->loadView('asmoyo::admin.page.index', $data, true);
	}

	public function create()
	{
		$data = array(
			'parentList'	=> $this->page->getParentPage(true),
			'structureList'	=> $this->page->getStructureList(),
			'statusList'	=> $this->page->getStatusList(),
			'typeList'		=> $this->page->getTypeList(),
		);
		return $this->loadView('asmoyo::admin.page.create', $data);
	}

	public function store()
	{
		$input = Input::all();
		// disable validation content if type value is not standard
		$rules = ($input['type'] != 'standard')
			? array('content' => '')
			: array();

		if ( $this->page->store($input, $rules ) )
		{
			return $this->redirectAlert('admin.page.index', 'success', 'Berhasil !!');
		}

		return $this->redirectAlert(false, 'danger', 'Gagal !!', $this->page->errors);
	}

	public function show($slug)
	{
		$data = array(
			'page'		=> $this->page->getBySlug($slug),
		);

		if( ! $data['page'] ) return App::abort(404);

		return 'here is show method';
	}

	public function edit($slug)
	{
		$page = $this->page->getBySlug($slug);
		$data = array(
			'page'			=> $page,
			'parentList'	=> $this->page->getParentPage(true, $page['id']),
			'structureList'	=> $this->page->getStructureList(),
			'statusList'	=> $this->page->getStatusList(),
			'typeList'		=> $this->page->getTypeList(),
		);

		if( ! $data['page'] ) return App::abort(404);

		return $this->loadView('asmoyo::admin.page.edit', $data);
	}

	public function update($slug)
	{
		$input = Input::all();
		// disable validation content if type value is not standard
		$rules = ($input['type'] != 'standard')
			? array('content' => '')
			: array();

		if ( $this->page->update( $input['id'], $input, $rules ) )
		{
			return $this->redirectAlert('admin.page.index', 'success', 'Berhasil Diperbarui !!');
		}

		return $this->redirectAlert(false, 'danger', 'Gagal !!', $this->page->errors);
	}

	public function editOrder()
	{
		$data = array(
			'pages'		=> $this->page->getAsMenu(),
		);
		// return $data['pages'];

		if( ! $data['pages'] ) return App::abort(404);

		return $this->setStructure('oneCollumn', 'admin')->loadView('asmoyo::admin.page.editOrder', $data, true);
	}

	public function editOrderSave()
	{
		$result_sortir = json_decode(Input::get('result_sortir'), true);
		$this->page->updateMenu($result_sortir);
		
		return $this->redirectAlert('admin.page.editOrder', 'success', 'Berhasil Diperbarui !!');
	}

	public function destroy($id)
	{
		if( $this->page->delete($id) )
		{
			return $this->redirectAlert('admin.page.index', 'success', 'Berhasil Dihapus !!');
		}
		return $this->redirectAlert('admin.page.index', 'danger', 'Gagal Dihapus !!');
	}

	public function forceDelete($id)
	{
		if( $this->page->delete($id, true) )
		{
			return $this->redirectAlert('admin.page.index', 'success', 'Berhasil Dihapus Permanent !!');
		}
		return $this->redirectAlert('admin.page.index', 'danger', 'Gagal Dihapus Permanent !!');
	}
}