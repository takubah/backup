<?php

// use Antoniputra\Asmoyo\Widgets\WidgetInterface;
use Antoniputra\Asmoyo\Utilities\Pseudo\Pseudo;

class Admin_DisplayController extends AsmoyoController
{
	public function index()
	{
		$data = array(
			'widgets'			=> app('Antoniputra\Asmoyo\Widgets\WidgetInterface')->getAll(),
			'pages'				=> app('Antoniputra\Asmoyo\Pages\PageInterface')->getAll(null, null, 'published'),
			'widgetContainer'	=> $this->widgetContainer()
		);
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
			
			// handle page widget if available
			default:
				$page_id = str_replace('page_', '', $position);
				if( $page = app('Antoniputra\Asmoyo\Pages\PageInterface')->getById($page_id) )
				{
					$containers = $page['content_structure'];
				}
				// if not found, throw 404
				else
				{
					return App::abort(404);
				}
				
			break;
		}
		
		// generate dropdown pseudo list
		if($containers) {
		foreach( $containers as $key => $c )
		{
			// if isset key widget. (key widget is important at here)
			if ( isset($c['widget']) AND $c['widget'] )
			{
				$query 	= app('Antoniputra\Asmoyo\Widgets\WidgetInterface')->getBySlug($c['widget']);

				// get widget item
				if ($query['has_item']) {
					foreach ($query['items'] as $q) {
						$default 	= "{<asmoyo:widget name=".$query['slug']." item=0>}";
						$pseudo		= "{<asmoyo:widget name=".$query['slug']." item=". $q['id'].">}";

						// this is pseudo dropdown list
		            	$item[$default] = 'tidak ada';
		            	$item[$pseudo] = $q['title'];
					}
				}
				// widget who haven't item (like search widget)
				else
				{
					$item = "{<asmoyo:widget name=".$query['slug'].">}";
				}
	        	// add item list
	        	$containers[$key]['item'] = $item; 

	        	// flush item list
	        	$item = null;
        	}
		} }
		// return $containers;

		$data = array(
			'position'			=> $position,
			'containers'		=> $containers,
		);

		return View::make('asmoyo::admin.display.ajaxSidebar', $data);
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
			$page_id = str_replace('page_', '', $position);
			$page 	= app('Antoniputra\Asmoyo\Pages\PageInterface')->getById( $page_id );
			$page->content_structure = array_merge($page['content_structure'], array($input));

			if ( $page->save() ) {
				return Response::json('Berhasil di buat !!', 200);
			} else {
				return Response::json(array('error' => 'something error cok jancok'), 500);
			}
		}

		if( app('Antoniputra\Asmoyo\Options\OptionInterface')->update($data) )
		{
			return Response::json('Berhasil di buat !!', 200);
		}
		return Response::json(array('error' => 'something error'), 500);
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

		if ($position == 'left') {
			$data['web_sideLeft'] 	= $new;
		}
		elseif($position == 'right') {
			$data['web_sideRight'] 	= $new;
		}
		else {
			$page_id = str_replace('page_', '', $position);
			$page 	= app('Antoniputra\Asmoyo\Pages\PageInterface')->getById( $page_id );
			$page->content_structure = $new;
			if ( $page->save() ) {
				return Response::json('Berhasil di buat !!', 200);
			} else {
				return Response::json(array('error' => 'something error cok jancok'), 500);
			}
		}

		if( app('Antoniputra\Asmoyo\Options\OptionInterface')->update($data) )
		{
			return Response::json('Berhasil di perbarui !!', 200);
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
		elseif ($position == 'right')
		{
			unset($web['web_sideRight'][$keyToRemove]);
			$data['web_sideRight'] 	= array_values($web['web_sideRight']);
		} else {
			$page_id = str_replace('page_', '', $position);
			$page 	= app('Antoniputra\Asmoyo\Pages\PageInterface')->getById( $page_id );
			$content_structure = $page['content_structure'];
			unset( $content_structure[$keyToRemove] );
			$page->content_structure = $content_structure;
			
			if ( $page->save() ) {
				return Response::json('Berhasil di hapus !!', 200);
			} else {
				return Response::json(array('error' => 'something error cok jancok'), 500);
			}
		}

		if( app('Antoniputra\Asmoyo\Options\OptionInterface')->update($data) )
		{
			return Response::json('Berhasil di hapus !!', 200);
		}
		return Response::json(array('error' => 'something error'), 500);
	}

	protected function widgetContainer( $container = array() )
	{
		// sidebar container
		$default = array(
			array(
				'id'	=> 'left',
				'title'	=> 'Sidebar Kiri',
			),
			array(
				'id'	=> 'right',
				'title'	=> 'Sidebar Kanan',
			),
		);

		// pages container
		$pages = app('Antoniputra\Asmoyo\Pages\PageInterface')->getAll(null, null, 'published');
		if ( $pages['items'] ) {
			foreach ($pages['items'] as $page) {
				$default[] = array(
					'id'	=> 'page_'.$page['id'],
					'title'	=> $page['title']
				);
			}
		}
		return $default;
	}
}