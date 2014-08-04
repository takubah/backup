<?php

// use Antoniputra\Asmoyo\Widgets\WidgetInterface;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class Admin_DisplayController extends AsmoyoController
{
	public function __construct()
	{
		
	}

	public function index()
	{
		// $widgets = App::make('Antoniputra\Asmoyo\Widgets\WidgetInterface')->getAll('all');

		$data = array(
			'widgets'			=> Pseudo::getList(),
			'widgetContainer'	=> array(
				'sideLeft' => 'Sidebar Kiri',
				'sideRight' => 'Sidebar Kanan'
			),
		);
		// return $data['widgets'];
		return $this->setStructure('oneCollumn', 'admin')->loadView('asmoyo::admin.display.index', $data, true);
	}

	public function update($position)
	{
		return Input::all();
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
			'position'	=> $position,
			'sidebar'	=> $sidebar,
			'pseudoTypeList' => Pseudo::typeList(),
			'pseudoSortirList' => Pseudo::sortirList(),
		);
		return View::make('asmoyo::admin.display.ajaxSidebar', $data);
	}

	public function ajaxSidebarAdd($position)
	{
		$web 	= app('asmoyo.web');
		$input = Input::all();

		if ($position == 'left')
			$data['web_sideLeft'] 	= array_merge($web['web_sideLeft'], array($input));
		else
			$data['web_sideRight'] 	= array_merge($web['web_sideRight'], array($input));

		if( app('Antoniputra\Asmoyo\Options\OptionInterface')->update($data) )
		{
			return Response::json('Berhasil di buat !!', 200);
		}

		return Response::json(array('error' => 'something error'), 500);
	}
}