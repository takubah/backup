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
		return $this->loadView('gallery.index', $data);
	}
}