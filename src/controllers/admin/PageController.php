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
		$data = array();
		return $this->loadView('asmoyo::admin.page.create', $data);
	}

	public function store()
	{
		return 'here is store method';
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
		);

		if( ! $data['page'] ) return App::abort(404);

		return $this->loadView('asmoyo::admin.page.edit', $data);
	}

	public function update($slug)
	{
		$data = array(
			'page'		=> $this->page->getBySlug($slug),
		);

		if( ! $data['page'] ) return App::abort(404);

		return 'here is update method';
	}

	public function editOrder()
	{
		$data = array(
			'pages'		=> $this->page->getAll(),
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

		return $this->redirectAlert('admin.page.editOrder', 'success', 'Berhasil !!');
	}

	public function destroy($id)
	{
		return 'ini adalah method destroy';
	}
}