<?php

// use Antoniputra\Asmoyo\Widgets\WidgetInterface;

class Admin_DisplayController extends AsmoyoController
{
	public function __construct()
	{
		
	}

	public function index()
	{
		$widgets = App::make('Antoniputra\Asmoyo\Widgets\WidgetInterface')->getAll();
		// return $widgets['items'];
		$data = array(
			'widgets'	=> $widgets['items']
		);
		return $this->setStructure('oneCollumn', 'admin')->loadView('asmoyo::admin.display.index', $data, true);
	}

	public function store()
	{
		return Input::all();
	}

	public function update($id)
	{

	}

}