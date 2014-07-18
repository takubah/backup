<?php namespace Antoniputra\Asmoyo\Posts;

interface PostInterface {

	public function getAll($limit = null, $sortir = null, $status = null);

	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null);

	public function getByType($type = 'article', $limit = null);

	public function getById($id);

	public function getBySlug($slug);
	
}