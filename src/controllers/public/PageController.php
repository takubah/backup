<?php

use Antoniputra\Asmoyo\Pages\PageInterface;

class Public_PageController extends AsmoyoController
{
	public function __construct(PageInterface $page)
	{
		$this->page = $page;
	}

	public function show($slug)
	{
		return 'ini adalah page show : '. $slug;
		$data = array();
		return $this->loadView('asmoyoTheme.baretshow.content.page.show', $data);
	}
}