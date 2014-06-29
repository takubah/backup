<?php

use Antoniputra\Asmoyo\Widgets\WidgetInterface;

class Api_Widget extends ApiController
{
	public function __construct(WidgetInterface $widget)
	{
		$this->widget = $widget;
	}

	public function index()
	{
		return $this->widget->getAll();
	}

	public function show($id)
	{
		 return $this->widget->getById($id);
	}

	public function showSlug($slug)
	{
		return $this->widget->getBySlug($slug);
	}
}