<?php namespace Antoniputra\Asmoyo\Pages;

interface PageInterface {

	public function getAll($sortir = null, $limit = null, $status = null);

	public function getAllPaginated($sortir = null, $limit = null, $status = null);

	public function getById($id);

	public function getBySlug($slug);

	public function getAsMenu();

	public function store($input = array(), $rules = array());

	public function update($id, $input = array(), $rules = array());

	public function delete($id, $is_permanent=false);
	
}