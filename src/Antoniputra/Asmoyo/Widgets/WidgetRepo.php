<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\RepoBase;

class WidgetRepo extends RepoBase implements WidgetInterface
{
	
	public function __construct(Widget $model, WidgetGroup $widgetGroup, WidgetItem $widgetItem)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );

		$this->widgetGroup 	= $widgetGroup;
		$this->widgetItem 	= $widgetItem;
	}

	public function getAll($limit=null)
	{
		return $this->model->with('groups.items')->get();
	}

	public function getById($id)
	{
		return $this->model->with('groups.items')->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->with('groups.items')
			->where('slug', $slug)->first();
	}

	public function getGroup()
	{
		return $this->widgetGroup->with('widget', 'items')->get();
	}

	public function getGroupBySlug($group_slug)
	{
		return $this->widgetGroup->with('widget', 'items')->where('slug', $group_slug)->first();
	}

}