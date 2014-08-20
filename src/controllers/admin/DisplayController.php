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
		$widgetContainer 	= array(
			'sideLeft' 	=> 'Sidebar Kiri',
			'sideRight' => 'Sidebar Kanan',
		);

		$data = array(
			// 'widgets'			=> Pseudo::getList(),
			'widgets'			=> app('Antoniputra\Asmoyo\Widgets\WidgetInterface')->getAll(),
			'widgetContainer'	=> $widgetContainer
		);
		// return $data['widgets']['items'];
		return $this->setStructure('oneCollumn', 'admin')->adminView('display.index', $data, false);
	}

	public function ajaxSidebar($position)
	{
		if ( ! Request::ajax() ) { return App::abort(404); }

		$web 	= app('asmoyo.web');
		switch ($position) {
			case 'left':
				$containers = $web['web_sideLeft'];
			break;

			case 'right':
				$containers = $web['web_sideRight'];
			break;
		
			default:
				return App::abort(404);
			break;
		}
		
		// merge dropdown pseudo list
		if($containers) {
		foreach( $containers as $key => $c )
		{
			$query 	= app('Antoniputra\Asmoyo\Widgets\WidgetInterface')->getBySlug($c['widget']);

			// get widget item
			if ($query['has_item']) {
				foreach ($query['items'] as $q) {
					$default = "{<asmoyo:widget slug=".$query['slug']." item=0>}";
					$pseudo	= "{<asmoyo:widget slug=".$query['slug']." item=". $q['id'].">}";
	            	$item[$default] = 'tidak ada';
	            	$item[$pseudo] = $q['title'];
				}
			} else {
				$item = "{<asmoyo:widget slug=".$query['slug'].">}";
			}
        	$containers[$key]['item'] = $item; // add item list
        	$item = null; // flush item list
		} }
		// return $containers;

		$data = array(
			'position'			=> $position,
			'containers'		=> $containers,
			'pseudoTypeList' 	=> Pseudo::typeList(),
			'pseudoSortirList' 	=> Pseudo::sortirList(),
		);

		return View::make('asmoyo::admin.display.ajaxSidebar', $data);
	}

	public function ajaxSidebarUpdate($position)
	{
		$web 	= app('asmoyo.web');
		$input 	= Input::all();
		foreach ($input['title'] as $key => $title) {
			$new[] 	= array(
				'title'		=> $title,
				'widget'	=> $input['widget'][$key],
				'content'	=> $input['pseudo'][$key],
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

	public function ajaxSidebarAdd($position)
	{
		$web 	= app('asmoyo.web');
		$input 	= Input::all();
		$data 	= array();

		if ($position == 'left')
		{
			$data['web_sideLeft'] 	= array_merge($web['web_sideLeft'], array($input));
		}
		elseif($position == 'right')
		{
			$data['web_sideRight'] 	= array_merge($web['web_sideRight'], array($input));
		}
		else
		{
			$page 	= app('Antoniputra\Asmoyo\Pages\PageInterface')->getById($input['page_id'])->toArray();
			// $page['content_structure'];
			return 'berhasil masuk page';
		}

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