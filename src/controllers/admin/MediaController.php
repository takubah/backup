<?php

use Antoniputra\Asmoyo\Medias\MediaInterface;

class Admin_MediaController extends AsmoyoController
{
	public function __construct(MediaInterface $media)
	{
		$this->media = $media;
	}
}