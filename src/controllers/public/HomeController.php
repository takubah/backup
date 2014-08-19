<?php

class Public_HomeController extends AsmoyoController
{
	public function index()
	{
		$data = array();
		return $this->loadView('content.home.index', $data);
	}

}