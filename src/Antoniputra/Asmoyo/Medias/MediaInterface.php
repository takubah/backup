<?php namespace Antoniputra\Asmoyo\Medias;

interface MediaInterface {

	public function getAllPaginated($limit);

	public function getByGallery($gallery_id);

	public function getByType($type);
	
}