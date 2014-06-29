<?php namespace Antoniputra\Asmoyo\Comments;

interface CommentInterface {

	public function getAll($limit=null);

	public function getDetail($id);
	
}