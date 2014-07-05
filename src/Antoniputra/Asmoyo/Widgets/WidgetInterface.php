<?php namespace Antoniputra\Asmoyo\Widgets;

interface WidgetInterface {

	public function getAll($sortir = null, $limit = null);

	public function getAllPaginated($sortir = null, $limit = null);

	public function getById($id);

	public function getBySlug($slug);
	
}