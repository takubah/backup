<?php

class Public_HomeController extends AsmoyoController
{
	public function index()
	{
		$data = array();
		// return getSidebar('left');
		return $this->setStructure('twoCollumn', 'public')->loadView('content.home.index', $data);
	}

}