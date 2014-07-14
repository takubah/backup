<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\RepoBase;

class UserRepo extends RepoBase implements UserInterface
{
	protected $editRules = array(
		'username'	=> 'required|unique:users,username,<id>',
        'email'		=> 'required|unique:users,email,<id>',
	);

	public function __construct(User $model)
	{
		parent::__construct($model);
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
		// check cache
		$key = __FUNCTION__.'|username:'.$username;
		if( $get = $this->cacheTag(__CLASS__)->get($key) ) return $get;
		
		$result = $this->model->where('username', $username)->first();

		// save cache
		$this->cacheTag(__CLASS__)->forever($key, $result);
		return $result;
	}

	public function auth()
	{
		$user = \Auth::user();
		if( $user )
		{
			$user = $user->toArray();
			$user['permissions'] 	= json_decode($user['permissions'], true);
		}
		return $user;
	}

	public function logout()
	{
		return \Auth::logout();
	}

}