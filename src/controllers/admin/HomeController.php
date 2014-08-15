<?php

class Admin_HomeController extends AsmoyoController
{
	public function dashboard()
	{
		$data = array();
		return $this->setStructure('oneCollumn', 'admin')->adminView('home.dashboard', $data);
	}

}