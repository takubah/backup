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
		return $this->loadView('asmoyo::admin.widget.index', $data);
	}

	public function show($slug)
	{
		$data = array(
			'widget'	=> $this->widget->getBySlug($slug),
		);

		if( ! $data['widget'] ) return App::abort(404);

		return 'here is show method';
	}

	public function enable($id)
	{
		if( $this->widget->enable($id) )
		{
			return $this->redirectAlert('admin.widget.index', 'success', 'Berhasil Diaktifkan !!');
		}
		return $this->redirectAlert(false, 'danger', 'Gagal Diaktifkan !!');
	}

	public function disable($id)
	{
		if( $this->widget->disable($id) )
		{
			return $this->redirectAlert('admin.widget.index', 'success', 'Berhasil Di non-aktifkan !!');
		}
		return $this->redirectAlert(false, 'danger', 'Gagal Di non-aktifkan !!');
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
		return $this->loadView('asmoyo::admin.widget.'.$widget['slug'].'.index', $data);
	}

	public function groupShow($widgetSlug, $groupSlug)
	{
		return 'ini adalah group Show '. $widgetSlug .' dan groupnya : '. $groupSlug;
	}
	
	public function groupCreate($widgetSlug)
	{
		return 'ini adalah group Show '. $widgetSlug;
	}
	
	public function groupStore($widgetSlug)
	{
		return 'ini adalah group Show '. $widgetSlug;
	}

	public function groupEdit($widgetSlug, $groupSlug)
	{
		// get widget first
		$widget = $this->widget->getBySlug($widgetSlug);
		if( ! $widget ) return App::abort(404);

		$data = array(
			'widget' 	=> $widget,
			'group' 	=> $this->widget->getGroupBySlug($groupSlug),
			'typeList'	=> $this->widget->getTypeList(),
		);
		
		return $this->loadView('asmoyo::admin.widget.'.$widget['slug'].'.edit', $data);
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

	public function groupDestroy($widgetSlug, $groupSlug)
	{
		return 'ini adalah group Show '. $widgetSlug .' dan itemnya : '. $groupSlug;
	}

}