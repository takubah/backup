<?php namespace Antoniputra\Asmoyo\Categories;

interface CategoryInterface
{
	public function getAll($limit=null);

	public function getById($id);

	public function getBySlug($slug);
}