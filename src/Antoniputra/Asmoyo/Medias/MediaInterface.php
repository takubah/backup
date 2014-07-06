<?php namespace Antoniputra\Asmoyo\Medias;

interface MediaInterface {

	public function getAll($sortir = null, $limit = null);

	public function getAllPaginated($sortir = null, $limit = null);

	public function getByGallery($gallery_id, $sortir = null, $limit = null);

	public function getByType($type, $sortir = null, $limit = null);
	
	public function getById($id);

	public function getBySlug($slug);
}