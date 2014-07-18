<?php namespace Antoniputra\Asmoyo\Categories;

interface CategoryInterface
{
	public function getAll($limit = null, $sortir = null, $status = null);

	public function getAllWithPosts($limit = null, $sortir = null, $status = null);

	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null);

	public function getAllPaginatedWithPosts($page = null, $limit = null, $sortir = null, $status = null);

	public function getById($id);

	public function getByIdWithPosts($id);

	public function getBySlug($slug);

	public function getBySlugWithPosts($slug);
}