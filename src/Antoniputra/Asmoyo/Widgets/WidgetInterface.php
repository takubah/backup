<?php namespace Antoniputra\Asmoyo\Widgets;

interface WidgetInterface {

	public function getAll($limit=null);

	public function getById($id);

	public function getBySlug($slug);
	
}