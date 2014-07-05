<?php

use Antoniputra\Asmoyo\Medias\MediaInterface;

class Admin_MediaController extends AsmoyoController
{
	public function __construct(MediaInterface $media)
	{
		$this->media = $media;
	}

	public function index()
	{
		$data = array(
			'medias'	=> $this->media->getAllPaginated(),
		);
		return $this->loadView('asmoyo::admin.media.index', $data);
	}

	public function create()
	{
		$data = array();
		return $this->loadView('asmoyo::admin.media.create', $data);
	}

	public function store()
	{
		return 'here is store method';
	}

	public function show($slug)
	{
		$data = array(
			'media'		=> $this->media->getBySlug($slug),
		);

		if( ! $data['media'] ) return App::abort(404);

		return 'here is show method';
	}

	public function edit($slug)
	{
		$data = array(
			'media'		=> $this->media->getBySlug($slug),
		);

		if( ! $data['media'] ) return App::abort(404);

		return $this->loadView('asmoyo::admin.media.edit', $data);
	}

	public function update($slug)
	{
		$data = array(
			'media'		=> $this->media->getBySlug($slug),
		);

		if( ! $data['media'] ) return App::abort(404);

		return 'here is update method';
	}

	public function destroy($id)
	{
		return 'ini adalah method destroy';
	}
}