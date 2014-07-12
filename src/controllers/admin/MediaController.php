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

	public function storeFroala()
	{
		if( $process = $this->media->store() )
		{
			// return Response::json(array('success' => $process), 200);
			return Response::json( array('link' => getMedia('e5e7fa671096d379df330cf9c8c54412.jpg') ), 200);
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

	public function edit($id)
	{
		$data = array(
			'media'		=> $this->media->getById($id),
		);

		if( ! $data['media'] ) return App::abort(404);

		return $this->loadView('asmoyo::admin.media.edit', $data);
	}

	public function update($id)
	{
		if( $process = $this->media->update($id) )
		{
			if( ! Request::ajax() ) return $this->redirectAlert('admin.media.index', 'success', 'Berhasil !!');

			return Response::json(array('success' => $process), 200);
		}

		if( ! Request::ajax() ) return $this->redirectAlert('admin.media.index', 'danger', 'Gagal !!');

		return Response::json(array('error' => 'error, pastikan file yg di upload ber-format : jpg, jpeg, gif, png'), 400);
	}

	public function destroy($id)
	{
		if( $process = $this->media->delete($id) ) {
			return $this->redirectAlert('admin.media.index', 'success', 'Berhasil Dihapus !!');
		}

		return $this->redirectAlert('admin.media.index', 'danger', 'Gagal Dihapus !!');
	}

	public function ajaxIndex()
	{
		if( ! Request::ajax()) { return App::abort(404); }

		$data = array(
			'medias'	=> $this->media->getAllPaginated(),
		);
		return View::make('asmoyo::admin.media.ajaxIndex', $data);
	}
}