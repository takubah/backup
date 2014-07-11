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
		if( $this->option->update( Input::all() ) )
		{
			return $this->redirectAlert('admin.option.web', 'success', 'Berhasil !!');
		}
		return $this->redirectAlert(false, 'danger', 'Gagal !');
	}

	public function media()
	{
		$data = array(
			'option'	=> $this->option->get(),
			'watermarkPositionList' => $this->option->watermarkPositionList(),
		);
		return $this->loadView('asmoyo::admin.option.media', $data);
	}

	public function mediaSave()
	{
		$input = Input::all();
		$input['media_constraint']['aspectRatio'] = isset($input['media_constraint']['aspectRatio']) ? 1 : 0;
		$input['media_constraint']['upsize'] = isset($input['media_constraint']['upsize']) ? 1 : 0;

		if( $this->option->update( $input ) )
		{
			return $this->redirectAlert('admin.option.media', 'success', 'Berhasil !!');
		}
		return $this->redirectAlert(false, 'danger', 'Gagal !');
	}
	
}