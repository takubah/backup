<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\RepoBase;

class UserRepo extends RepoBase implements UserInterface
{
	
	public function __construct(User $model)
	{
		parent::__construct($model);
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getAll($sortir = null, $limit = null)
	{
		return $this->prepareData($sortir, $limit)->get();
	}

	public function getAllPaginated($sortir = null, $limit = null)
	{
		return $this->prepareData()->paginate( $this->repoLimit($limit) );
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

	public function auth()
	{
		// if($cachedResult = $this->cacheGet(__FUNCTION__)) 
		// 	return $cachedResult;

		$user = \Auth::user();

		if( $user )
		{
			$user = $user->toArray();
			$user['permissions'] 	= json_decode($user['permissions'], true);
		}

		// return $this->cacheStore( __FUNCTION__, $user );
		return $user;
	}

	public function logout()
	{
		$this->cacheForget('auth');
		return \Auth::logout();
	}

}