<?php

class Public_HomeController extends AsmoyoController
{
	public function index()
	{
		$data = array();
		return $this->setStructure('twoCollumn', 'public')->loadView('content.home.index', $data);
	}
}