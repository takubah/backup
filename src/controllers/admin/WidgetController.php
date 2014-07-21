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

	
	// group

	public function group($widgetSlug)
	{
		$widgets = $this->widget->getAllPaginated();
		$data 	= array(
			'widgets'	=> Paginator::make($widgets, $widgets['total'], $widgets['limit']),
		);
		// return $data['widgets'];
		return $this->loadView('asmoyo::admin.widget.index', $data);
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
		return 'ini adalah group Show '. $widgetSlug .' dan groupnya : '. $groupSlug;
	}
	
	public function groupUpdate($widgetSlug, $groupSlug)
	{
		return 'ini adalah group Show '. $widgetSlug .' dan groupnya : '. $groupSlug;
	}

	public function groupDelete($widgetSlug, $groupSlug)
	{
		return 'ini adalah group Show '. $widgetSlug .' dan groupnya : '. $groupSlug;
	}

}