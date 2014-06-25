<?php

use Antoniputra\Asmoyo\Medias\MediaInterface;

class Api_Media extends ApiController
{
	public function __construct(MediaInterface $media)
	{
		$this->media = $media;
	}

	public function index()
	{
		return $this->media->getAll();
	}

	public function show($id)
	{
		return $this->media->getById($id);
	}

	public function showSlug($slug)
	{
		return $this->media->getBySlug($slug);
	}
}