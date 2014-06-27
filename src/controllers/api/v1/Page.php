<?php

use Antoniputra\Asmoyo\Pages\PageInterface;

class Api_Page extends ApiController
{
	public function __construct(PageInterface $page)
	{
		$this->page = $page;
	}

	public function index()
	{
		return $this->page->getAll();
	}

	public function show($id)
	{
		return $this->page->getById($id);
	}

	public function showSlug($slug)
	{
		return $this->page->getBySlug($slug);
	}
}