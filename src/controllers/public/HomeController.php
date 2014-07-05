<?php

use Antoniputra\Asmoyo\Users\UserInterface;

class Public_HomeController extends AsmoyoController
{
	public function __construct()
	{
		// $this->user = $user;
	}

	public function index()
	{
		$data = array();
		return $this->setStructure('oneCollumn')
			->loadView('asmoyoTheme.baretshow.content.home', $data);
	}

}