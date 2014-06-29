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
		return $this->category->getAll();
	}

	public function show($id)
	{
		return $this->category->getById($id);
	}

	public function showSlug($slug)
	{
		return $this->category->getBySlug($slug);
	}

}