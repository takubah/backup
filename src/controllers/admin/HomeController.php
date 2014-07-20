<?php

class Admin_HomeController extends AsmoyoController
{
	public function dashboard()
	{
		// return app('Antoniputra\Asmoyo\Categories\CategoryInterface')->getById(1);
		$data = array();
		return $this->loadView('asmoyo::admin.home.dashboard', $data);
	}

}