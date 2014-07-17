<?php namespace Antoniputra\Asmoyo\Users;

interface UserInterface {

	public function getAll($limit = null, $sortir = null, $status = null);

	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null);

	public function getById($id);

	public function getByUsername($username);
	
}