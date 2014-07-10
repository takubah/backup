<?php

use Antoniputra\Asmoyo\Options\OptionInterface;

class Admin_OptionController extends AsmoyoController
{
	public function __construct(OptionInterface $option)
	{
		$this->option = $option;
	}

	public function index()
	{
		return app('asmoyo.web');
	}

	public function web()
	{
		$data = array(
			'option'		=> $this->option->get(),
			'dateFormatList' => $this->option->dateFormatList(),
			'sortirList' 	=> $this->option->getSortirList(),
		);
		return $this->loadView('asmoyo::admin.option.web', $data);
	}

	public function webSave()
	{
		$input = Input::all();
		$input['web_logo'] = $input['asmoyo_image_new'] ?: $input['web_logo'];
		if( $this->option->update($input) )
		{
			return $this->redirectAlert('admin.option.web');
		}
		return $this->redirectAlert(false, 'danger', 'Error');
	}

	public function media()
	{
		$data = array(
			'option'	=> $this->option->get(),
		);
		return $this->loadView('asmoyo::admin.option.media', $data);
	}

	
}