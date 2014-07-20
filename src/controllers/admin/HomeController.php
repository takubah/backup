<?php

class Admin_HomeController extends AsmoyoController
{
	public function dashboard()
	{
		// return app('Antoniputra\Asmoyo\Posts\PostInterface')->getAll()['items'];
		$data = array();
		return $this->loadView('asmoyo::admin.home.dashboard', $data);
	}

}