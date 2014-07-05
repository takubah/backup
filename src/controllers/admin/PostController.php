<?php

use Antoniputra\Asmoyo\Posts\PostInterface;

class Admin_PostController extends AsmoyoController
{
	public function __construct(PostInterface $post)
	{
		$this->post = $post;
	}

	public function index()
	{
		$data = array(
			'posts'		=> $this->post->getAllPaginated(),
		);
		return $this->loadView('asmoyo::admin.post.index', $data);
	}

	public function create()
	{
		$data = array();
		return $this->loadView('asmoyo::admin.post.create', $data);
	}

	public function store()
	{
		return 'here is store method';
	}

	public function show($slug)
	{
		$data = array(
			'post'		=> $this->post->getBySlug($slug),
		);

		if( ! $data['post'] ) return App::abort(404);

		return 'here is show method';
	}

	public function edit($slug)
	{
		$data = array(
			'post'		=> $this->post->getBySlug($slug),
		);

		if( ! $data['post'] ) return App::abort(404);

		// return $data['post'];

		return $this->loadView('asmoyo::admin.post.edit', $data);
	}

	public function update($slug)
	{
		$data = array(
			'post'		=> $this->post->getBySlug($slug),
		);

		if( ! $data['post'] ) return App::abort(404);

		return 'here is update method';
	}

	public function destroy($id)
	{
		return 'ini adalah method destroy';
	}
}