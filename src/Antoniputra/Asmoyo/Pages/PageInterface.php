<?php namespace Antoniputra\Asmoyo\Pages;

interface PageInterface {

	public function getAll($limit=null);

	public function getById($id);

	public function getBySlug($slug);

	public function getAsMenu();
	
}