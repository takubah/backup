<?php namespace Antoniputra\Asmoyo\Widgets;

interface WidgetInterface {

	public function getAll($limit = null, $sortir = null, $status = null);

	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null);

	public function getById($id, $itemId = null);

	public function getBySlug($slug, $itemId = null);
	
}