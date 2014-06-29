<?php namespace Antoniputra\Asmoyo\Galleries;

interface GalleryInterface
{
	public function getAll($limit=null);

	public function getById($id);

	public function getBySlug($slug);
}