<?php

class Admin_HomeController extends AsmoyoController
{
	public function dashboard()
	{
		// return app('Antoniputra\Asmoyo\Categories\CategoryInterface')->getAll()['items'];
		$data = array();
		return $this->loadView('asmoyo::admin.home.dashboard', $data, false);
	}

}