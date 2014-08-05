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
		$data = array(
			'widgets'			=> Pseudo::getList(),
			'widgetContainer'	=> array(
				'sideLeft' => 'Sidebar Kiri',
				'sideRight' => 'Sidebar Kanan'
			),
		);
		return $this->setStructure('oneCollumn', 'admin')->loadView('asmoyo::admin.display.index', $data, true);
	}

	public function ajaxUpdate($position)
	{
		$web 	= app('asmoyo.web');
		$input 	= Input::all();
		foreach ($input['title'] as $key => $title) {
			$new[] 	= array(
				'title'		=> $title,
				'content'	=> '{<asmoyo:'.$input["object"][$key].' type='.$input["type"][$key].' sortir='.$input["sortir"][$key].' widget-name='.$input["widget_name"][$key] .'>}',
			);
		}

		if ($position == 'left')
			$data['web_sideLeft'] 	= $new;
		else
			$data['web_sideRight'] 	= $new;

		if( app('Antoniputra\Asmoyo\Options\OptionInterface')->update($data) )
		{
			return Response::json('Berhasil di perbarui !!', 200);
		}
		return Response::json(array('error' => 'something error'), 500);
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
		$input 	= Input::all();
		$data 	= array();

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

	public function ajaxSidebarRemove($position)
	{
		$web 	= app('asmoyo.web');
		$keyToRemove = (integer) Input::get('key');
		$data 	= array();

		if ($position == 'left')
		{
			unset($web['web_sideLeft'][$keyToRemove]);
			$data['web_sideLeft'] 	= array_values($web['web_sideLeft']);
		}
		else
		{
			unset($web['web_sideRight'][$keyToRemove]);
			$data['web_sideRight'] 	= array_values($web['web_sideRight']);
		}

		if( app('Antoniputra\Asmoyo\Options\OptionInterface')->update($data) )
		{
			return Response::json('Berhasil di hapus !!', 200);
		}
		return Response::json(array('error' => 'something error'), 500);
	}
}