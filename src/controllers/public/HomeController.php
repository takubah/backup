<?php

class Public_HomeController extends AsmoyoController
{
	public function index()
	{
		$data = array();
		return $this->setStructure('oneCollumn')
			->loadView('content.home', $data, true);
	}

}