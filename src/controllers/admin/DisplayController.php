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

		$data = array(
			'widgets'	=> $widgets['items'],
			'widgetContainer'	=> array(
				'sideLeft' => 'Sidebar Kiri',
				'sideRight' => 'Sidebar Kanan'
			),
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

	public function ajaxSidebar($position)
	{
		sleep(1);
		if ( ! Request::ajax() ) { return App::abort(404); }

		$web 	= app('asmoyo.web');
		$sidebar = ($position == 'left')
			? $web['web_sideLeft']
			: $web['web_sideRight'];

		$data = array(
			'sidebar'	=> $sidebar
		);
		return View::make('asmoyo::admin.display.ajaxSidebar', $data);
	}

}