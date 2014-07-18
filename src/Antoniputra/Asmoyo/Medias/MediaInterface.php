<?php namespace Antoniputra\Asmoyo\Medias;

interface MediaInterface {

	public function getAll($limit = null, $sortir = null, $status = null);

	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null);

	public function getByGallery($gallery_id, $sortir = null, $limit = null);

	public function getByType($type, $sortir = null, $limit = null);
	
	public function getById($id);

	public function getBySlug($slug);
}