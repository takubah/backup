<?php

use Antoniputra\Asmoyo\Categories\CategoryInterface;

class Admin_CategoryController extends AsmoyoController
{
	public function __construct(CategoryInterface $category)
	{
		$this->category = $category;
	}
}