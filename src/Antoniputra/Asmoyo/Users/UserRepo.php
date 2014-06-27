<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\RepoBase;

class UserRepo extends RepoBase implements UserInterface
{
	
	public function __construct(User $model)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getAll($limit=null)
	{
		return $this->prepareData()
			->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		return $this->model->find($id);
	}

	public function getByUsername($username)
	{
		$cacheKey = __FUNCTION__.'|'.$username;

		// check cache
		if($cachedResult = $this->cacheGet($cacheKey)) {
			return $cachedResult;
		}
		
		return $this->cacheStore( $cacheKey, $this->model->where('username', $username)->first() );
	}

}