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
		$data = array(
			'pages'		=> $this->page->getAllPaginated(),
		);
		return $this->loadView('asmoyo::admin.page.index', $data);
	}

	public function create()
	{
		$data = array(
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
		$data = array(
			'page'		=> $this->page->getBySlug($slug),
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
			'pages'		=> $this->page->getAll(null, null, 'published'),
		);

		if( ! $data['pages'] ) return App::abort(404);

		return $this->setStructure('oneCollumn', 'admin')->loadView('asmoyo::admin.page.editOrder', $data);
	}

	public function editOrderSave()
	{
		$result_sortir = json_decode(Input::get('result_sortir'), true);

		if($result_sortir)
		{
			foreach ($result_sortir[0] as $order => $value)
			{
				$this->page->model->where('id', $value['id'])->update(array('order' => $order));
			}
		}

		return $this->redirectAlert('admin.page.editOrder', 'success', 'Berhasil Diperbarui !!');
	}

	public function destroy($id)
	{
		return 'ini adalah method destroy';
	}
}