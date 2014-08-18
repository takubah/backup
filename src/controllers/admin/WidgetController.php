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
		$widgets = $this->widget->getAllPaginated();
		$data 	= array(
			'widgets'	=> Paginator::make($widgets, $widgets['total'], $widgets['limit']),
		);
		return $this->setStructure('twoCollumn', 'admin')->adminView('widget.index', $data);
	}

	public function show($slug)
	{
		$data = array(
			'widget'	=> $this->widget->getBySlug($slug),
		);

		if( ! $data['widget'] ) return App::abort(404);

		return $this->setStructure('twoCollumn', 'admin')->adminView('widget.show', $data);
	}


	/**
	* Widget Item
	*/

	public function item($widgetSlug, $itemId)
	{
		$widget = $this->widget->getBySlug($widgetSlug, $itemId);
		if( ! $widget OR ! $widget['item'] ) return App::abort(404);

		$data 	= array(
			'widget'	=> $widget,
			'content'	=> $widget['item']['content'],
			'title'		=> $widget['title'] .' - '. $widget['item']['title'],
		);
		$widgetView	= $widget['slug'];
		// return $widget;
		
		return $this->setStructure('twoCollumn', 'admin')
			->adminView('widget.resource.'. $widgetView, $data);
	}

	public function itemCreate($widgetSlug)
	{
		$widget = $this->widget->getBySlug($widgetSlug);
		if( ! $widget ) return App::abort(404);

		$data 	= array(
			'widget'	=> $widget,
			'attribute'	=> $widget['attribute'],
			'title'		=> $widget['title'] .' - Buat Item',
		);
		$widgetView	= $widget['slug'] .'_create';
		
		return $this->setStructure('twoCollumn', 'admin')
			->adminView('widget.resource.'. $widgetView, $data);
	}

	public function itemStore($widgetSlug)
	{
		$widget = $this->widget->getBySlug($widgetSlug);
		if( ! $widget ) return App::abort(404);

		if ( $this->widget->itemStore(Input::all()) )
		{
			return $this->redirectAlert(route('admin.widget.show', $widgetSlug), 'success', 'Berhasil Dibuat !!');
		}
		return $this->redirectAlert(false, 'danger', 'Gagal !!', $this->widget->errors);
	}

	public function itemEdit($widgetSlug, $itemId)
	{
		$widget = $this->widget->getBySlug($widgetSlug, $itemId);
		if( ! $widget OR ! $widget['item'] ) return App::abort(404);

		$data 	= array(
			'widget'	=> $widget,
			'content'	=> $widget['item']['content'],
			'title'		=> 'Edit '. $widget['title'] .' - '. $widget['item']['title'],
		);
		// return $widget;
		$widgetView	= $widget['slug'].'_edit';
		
		return $this->setStructure('twoCollumn', 'admin')
			->adminView('widget.resource.'. $widgetView, $data);
	}

	public function itemUpdate($widgetSlug, $itemId)
	{
		$widget = $this->widget->getBySlug($widgetSlug, $itemId);
		if( ! $widget OR ! $widget['item'] ) return App::abort(404);

		if ( $this->widget->itemUpdate($itemId, Input::all()) )
		{
			return $this->redirectAlert(route('admin.widget.show', $widgetSlug), 'success', 'Berhasil Diperbarui !!');
		}
		return $this->redirectAlert(false, 'danger', 'Gagal !!', $this->widget->errors);
	}

	public function itemForceDelete($widgetSlug, $itemId)
	{
		$this->widget->itemDelete($itemId);

		return $this->redirectAlert(route('admin.widget.show', $widgetSlug), 'success', 'Berhasil Dihapus !!');
	}

	
	/**
	* Widget Group
	*/

	public function group($widgetSlug)
	{
		// get widget first
		$widget = $this->widget->getBySlug($widgetSlug);
		if( ! $widget ) return App::abort(404);

		$groups = $this->widget->getGroupAllPaginated($widget['id']);
		$data 	= array(
			'widget' => $widget,
			'groups' => Paginator::make($groups, $groups['total'], $groups['limit']),
		);
		return $this->setStructure('twoCollumn', 'admin')->adminView('widget.'.$widget['slug'].'.index', $data);
	}

	public function groupShowAjax($widgetSlug, $groupSlug)
	{
		if( ! Request::ajax()) { return App::abort(404); }
		
		// get widget and widgetGroup first
		$widget = $this->widget->getBySlugWithGroup($widgetSlug, $groupSlug);
		if( ! $widget['group'] ) return App::abort(404);

		$data = array(
			'widget' 	=> $widget,
		);
		
		return View::make('asmoyo::admin.widget.'.$widget['slug'].'.show', $data);
	}
	
	public function groupCreate($widgetSlug)
	{
		// get widget first
		$widget = $this->widget->getBySlug($widgetSlug);
		if( ! $widget ) return App::abort(404);

		$data = array(
			'widget' 	=> $widget,
			'typeList'	=> $this->widget->getTypeList(),
		);
		
		return $this->adminView('widget.'.$widget['slug'].'.create', $data);
	}
	
	public function groupStore($widgetSlug)
	{
		$widget 	= $this->widget->getBySlug($widgetSlug);
		$input 		= Input::all();
		
		if( $result = $this->widget->groupStore($input['widget_id'], $input) )
		{
			return $this->redirectAlert( route('admin.widget.group', $widget['slug']), 'success', 'Berhasil Ditambahkan !');
		}
		return Redirect::back()->with('alert', array(
			'type'		=> 'danger',
			'title'		=> 'Gagal',
			'text'		=> $this->widget->errors
		));
	}

	public function groupEdit($widgetSlug, $groupSlug)
	{
		$widget = $this->widget->getBySlugWithGroup($widgetSlug, $groupSlug);
		if( ! $widget['group'] ) return App::abort(404);

		$data = array(
			'widget' 	=> $widget,
			'typeList'	=> $this->widget->getTypeList(),
		);
		
		return $this->adminView('widget.'.$widget['slug'].'.edit', $data);
	}
	
	public function groupUpdate($widgetSlug, $groupSlug)
	{
		$widget 	= $this->widget->getBySlug($widgetSlug);
		$input 		= Input::all();
		
		if( $this->widget->groupUpdate($input['widget_id'], $input['id'], $input) )
		{
			return $this->redirectAlert( route('admin.widget.group', $widget['slug']), 'success', 'Berhasil Diperbarui !');
		}

		return Redirect::back()->with('alert', array(
			'type'		=> 'danger',
			'title'		=> 'Gagal',
			'text'		=> $this->widget->errors
		));
	}

	public function groupDestroy($widgetSlug, $groupId)
	{
		if( $this->widget->groupDelete($groupId) )
		{
			return $this->redirectAlert(null, 'success', 'Berhasil Dihapus !!');
		}
		return $this->redirectAlert(null, 'danger', 'Gagal Dihapus !!');
	}

}