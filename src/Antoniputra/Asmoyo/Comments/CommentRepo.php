<?php namespace Antoniputra\Asmoyo\Comments;

use Antoniputra\Asmoyo\Cores\RepoBase;

class CommentRepo extends RepoBase implements CommentInterface
{
	
	public function __construct(Comment $model)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getAll($limit=null)
	{

	}

	public function getDetail($id)
	{

	}

}