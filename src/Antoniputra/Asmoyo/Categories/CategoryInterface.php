<?php namespace Antoniputra\Asmoyo\Categories;

interface CategoryInterface
{
	public function getCategories($limit=null);

	public function getCategoryById($id);

	public function getCategoryBySlug($slug);


	public function getGalleries($limit=null);

	public function getGalleryById($id);

	public function getGalleryBySlug($slug);
}