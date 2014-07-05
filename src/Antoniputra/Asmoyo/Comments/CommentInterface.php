<?php namespace Antoniputra\Asmoyo\Comments;

interface CommentInterface {

	public function getAll($sortir = null, $limit = null);

	public function getAllPaginated($sortir = null, $limit = null);

	public function getById($id);
	
}