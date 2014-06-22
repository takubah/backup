<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\RepoBase;

class UserRepo extends RepoBase {
	
	public function __construct(User $model)
	{
		$this->model = $model;
	}

}