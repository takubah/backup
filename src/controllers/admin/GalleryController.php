<?php

use Antoniputra\Asmoyo\Galleries\GalleryInterface;

class Admin_GalleryController extends AsmoyoController
{
	public function __construct(GalleryInterface $gallery)
	{
		$this->gallery = $gallery;
	}

	public function index()
	{
		$galleries 	= $this->gallery->getAllPaginated();
		$data 		= array(
			'galleries'	=> Paginator::make($galleries, $galleries['total'], $galleries['limit']),
		);
		return $this->adminView('gallery.index', $data);
	}

	public function create()
	{
		return 'here is create view';
	}

	public function store()
	{
		return 'here is post craete';
	}

	public function edit($slug)
	{
		$gallery 	= $this->gallery->getBySlug($slug);
		$data 		= array(
			'gallery'		=> $gallery,
			'statusList'	=> $this->gallery->getStatusList(),
		);
		return $this->adminView('gallery.edit', $data);
	}

	public function update($slug)
	{
		return 'here is gallery update';
	}

	public function destroy($id)
	{
		return 'here is gallery destroy';
	}
}