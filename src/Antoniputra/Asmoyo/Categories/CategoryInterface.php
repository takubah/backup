<?php namespace Antoniputra\Asmoyo\Categories;

interface CategoryInterface
{
	public function getAll($page = null, $limit = null);

	public function getAllWithPosts($page = null, $limit = null);

	public function getAllPaginated($page = null, $limit = null);

	public function getAllPaginatedWithPosts($page = null, $limit = null);

	public function getById($id);

	public function getByIdWithPosts($id);

	public function getBySlug($slug);

	public function getBySlugWithPosts($slug);
}