<?php

use Antoniputra\Asmoyo\Posts\PostInterface;

class Api_Post extends ApiController
{
	public function __construct(PostInterface $post)
	{
		$this->post = $post;
	}

	public function index()
	{
		return $this->post->getAll();
	}

	public function show($id)
	{
		 return $this->post->getById($id);
	}

	public function showSlug($slug)
	{
		return $this->post->getBySlug($slug);
	}
}