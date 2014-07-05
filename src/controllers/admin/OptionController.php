<?php

use Antoniputra\Asmoyo\Options\OptionInterface;

class Admin_OptionController extends AsmoyoController
{
	public function __construct(OptionInterface $option)
	{
		$this->option = $option;
	}

	public function index()
	{
		$data = array(
			'options'	=> $this->option->get(),
		);
		return $this->loadView('asmoyo::admin.option.index', $data);
	}

	public function create()
	{
		$data = array();
		return $this->loadView('asmoyo::admin.option.create', $data);
	}

	public function store()
	{
		return 'here is store method';
	}

	public function show($slug)
	{
		$data = array(
			'option'		=> $this->option->get(),
		);

		if( ! $data['option'] ) return App::abort(404);

		return 'here is show method';
	}

	public function edit($slug)
	{
		$data = array(
			'option'		=> $this->option->get(),
		);

		if( ! $data['option'] ) return App::abort(404);

		return $this->loadView('asmoyo::admin.option.edit', $data);
	}

	public function update($slug)
	{
		$data = array(
			'option'		=> $this->option->get(),
		);

		if( ! $data['option'] ) return App::abort(404);

		return 'here is update method';
	}

	public function destroy($id)
	{
		return 'ini adalah method destroy';
	}
}