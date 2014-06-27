<?php namespace Antoniputra\Asmoyo\Users;

interface UserInterface {

	public function getAll($limit=null);

	public function getById($id);

	public function getByUsername($username);
	
}