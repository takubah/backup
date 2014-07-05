<?php namespace Antoniputra\Asmoyo\Users;

interface UserInterface {

	public function getAll($sortir = null, $limit = null);

	public function getAllPaginated($sortir = null, $limit = null);

	public function getById($id);

	public function getByUsername($username);
	
}