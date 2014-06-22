<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\RepoBase;

class WidgetRepo extends RepoBase {
	
	public function __construct(Widget $model)
	{
		$this->model = $model;
	}

}