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
		$page = $this->page->getBySlug($slug);
		$data = array(
			'page'	=> $page,
		);

		return $this->setStructure($page['structure'], 'public')->loadView('content.page.show', $data);
	}
}