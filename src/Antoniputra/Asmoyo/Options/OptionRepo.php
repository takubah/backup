<?php namespace Antoniputra\Asmoyo\Options;

use Antoniputra\Asmoyo\Cores\RepoBase;

class OptionRepo extends RepoBase {
	
	public function __construct(Option $model)
	{
		$this->model = $model;
	}

}