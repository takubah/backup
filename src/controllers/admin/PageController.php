<?php

use Antoniputra\Asmoyo\Pages\PageInterface;

class Admin_PageController extends AsmoyoController
{
	public function __construct(PageInterface $page)
	{
		$this->page = $page;
	}
}