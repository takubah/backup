<?php

use Antoniputra\Asmoyo\Users\UserInterface;

class Api_User extends ApiController
{
	public function __construct(UserInterface $user)
	{
		$this->user = $user;
	}

	public function index()
	{
		return $this->user->getAll();
	}

	public function show($id)
	{
		return $this->user->getById($id);
	}

	public function showUsername($username)
	{
		return $this->user->getByUsername($username);
	}
}