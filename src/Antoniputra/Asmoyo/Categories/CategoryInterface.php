<?php namespace Antoniputra\Asmoyo\Categories;

interface CategoryInterface
{
	public function getCategories($limit=null);

	public function getCategoryById();

	public function getCategoryBySlug();


	public function getGalleries($limit=null);

	public function getGaleryById();

	public function getGaleryBySlug();
}