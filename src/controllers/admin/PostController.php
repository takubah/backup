<?php

use Antoniputra\Asmoyo\Posts\PostInterface;

class Admin_PostController extends AsmoyoController
{
	public function __construct(PostInterface $post)
	{
		$this->post = $post;
	}
}