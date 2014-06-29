<?php

use Antoniputra\Asmoyo\Galleries\GalleryInterface;

class Api_Gallery extends ApiController
{
	public function __construct(GalleryInterface $gallery)
	{
		$this->gallery = $gallery;
	}

	public function index()
	{
		return $this->gallery->getAll();
	}

	public function show($id)
	{
		return $this->gallery->getById($id);
	}

	public function showSlug($slug)
	{
		return $this->gallery->getBySlug($slug);
	}
}