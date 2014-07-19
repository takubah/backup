<?php

class Admin_HomeController extends AsmoyoController
{
	public function dashboard()
	{
		$data = array();
		return $this->loadView('asmoyo::admin.home.dashboard', $data, false);
	}

}