<?php namespace Antoniputra\Asmoyo\Medias;

interface MediaInterface {

	public function getAll($limit=null);

	public function getByGallery($gallery_id, $limit=null);

	public function getByType($type, $limit=null);
	
}