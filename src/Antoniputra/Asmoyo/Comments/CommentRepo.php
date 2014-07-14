<?php namespace Antoniputra\Asmoyo\Comments;

use Antoniputra\Asmoyo\Cores\RepoBase;

class CommentRepo extends RepoBase implements CommentInterface
{
	protected $editRules = array(
		
	);

	public function __construct(Comment $model)
	{
		parent::__construct($model);
	}

	public function getAll($sortir = null, $limit = null)
	{
		$result = $this->prepareData($sortir, $limit)->with('objectable', 'user')->get();
		return $result;
	}

	public function getAllPaginated($sortir = null, $limit = null)
	{
		return $this->prepareData($sortir, $limit)->with('objectable', 'user')
			->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		return $this->model->with('objectable', 'user')->find($id);
	}

}