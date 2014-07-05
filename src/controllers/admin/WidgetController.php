<?php

use Antoniputra\Asmoyo\Widgets\WidgetInterface;

class Admin_WidgetController extends AsmoyoController
{
	public function __construct(WidgetInterface $widget)
	{
		$this->widget = $widget;
	}

	public function index()
	{
		$data = array(
			'widgets'	=> $this->widget->getAllPaginated(),
		);
		return $this->loadView('asmoyo::admin.widget.index', $data);
	}

	public function create()
	{
		$data = array();
		return $this->loadView('asmoyo::admin.widget.create', $data);
	}

	public function store()
	{
		return 'here is store method';
	}

	public function show($slug)
	{
		$data = array(
			'widget'		=> $this->widget->getBySlug($slug),
		);

		if( ! $data['widget'] ) return App::abort(404);

		return 'here is show method';
	}

	public function edit($slug)
	{
		$data = array(
			'widget'		=> $this->widget->getBySlug($slug),
		);

		if( ! $data['widget'] ) return App::abort(404);

		return $this->loadView('asmoyo::admin.widget.edit', $data);
	}

	public function update($slug)
	{
		$data = array(
			'widget'		=> $this->widget->getBySlug($slug),
		);

		if( ! $data['widget'] ) return App::abort(404);

		return 'here is update method';
	}

	public function destroy($id)
	{
		return 'ini adalah method destroy';
	}
}