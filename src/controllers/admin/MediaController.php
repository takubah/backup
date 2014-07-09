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
		return app('asmoyo.web');
		
		$data = array(
			'medias'	=> $this->media->getAllPaginated(),
		);
		return $this->setStructure('oneCollumn', 'admin')->loadView('media.index', $data, true);
	}

	public function create()
	{
		$data = array();
		return $this->loadView('asmoyo::admin.media.create', $data);
	}

	public function store()
	{
		if( ! Request::ajax()) { return App::abort(404); }

		if( $process = $this->media->store() )
		{
			return Response::json(array('success' => $process), 200);
		}

		return Response::json(array('error' => 'error, pastikan file yg di upload ber-format : jpg, jpeg, gif, png'), 400);
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