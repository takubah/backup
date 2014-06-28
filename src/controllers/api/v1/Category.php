<?php

use Antoniputra\Asmoyo\Categories\CategoryInterface;

class Api_Category extends ApiController
{
	public function __construct(CategoryInterface $category)
	{
		$this->category = $category;
	}

	public function index()
	{
		return $this->category->getCategories();
	}

	public function show($id)
	{
		return $this->category->getCategoryById($id);
	}

	public function showSlug($slug)
	{
		return $this->category->getCategoryBySlug($slug);
	}

	public function gallery()
	{
		return $this->category->getGalleries();
	}

	public function galleryShow($id)
	{
		return $this->category->getGalleryById($id);
	}

	public function galleryShowSlug($slug)
	{
		return $this->category->getGalleryBySlug($slug);
	}

}