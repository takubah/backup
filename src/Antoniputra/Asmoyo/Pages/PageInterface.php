<?php namespace Antoniputra\Asmoyo\Pages;

interface PageInterface {

	public function getAll($sortir = null, $limit = null);

	public function getAllPaginated($sortir = null, $limit = null);

	public function getById($id);

	public function getBySlug($slug);

	public function getAsMenu();
	
}