<?php

class Public_PostController extends AsmoyoController
{
	public function index()
	{
		$data = array();
		return $this->loadView('asmoyoTheme.baretshow.content.post.index', $data, true);
	}

	public function show($id)
	{
		$data = array();
		return $this->loadView('asmoyoTheme.baretshow.content.post.show', $data);
	}
}