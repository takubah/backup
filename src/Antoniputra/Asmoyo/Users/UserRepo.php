<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\RepoBase;
use Input;

class UserRepo extends RepoBase implements UserInterface
{
	protected $editRules = array(
		'username'	=> 'required|min:5|unique:users,username,<id>',
        'email'		=> 'required|unique:users,email,<id>',
        'password'	=> '',
	);

	public function __construct(User $model)
	{
		$this->model = $model;
	}

	public function getCacheTag($key = 'one')
	{
		$one 	= $this->model->getTable() .'_oneData';
		$many 	= $this->model->getTable();
		$tags 	= array(
			'one'	=> $one,
			'many'	=> $many,
			'both'	=> array($one, $many),
		);

		if( ! isset($tags[$key]) )
			throw new \Exception($key ." Key not available", 1);

		return $tags[$key];
	}

	public function getAll($limit = null, $sortir = null, $status = null)
	{
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = array(
			'limit' => $limit,
			'sortir' => $sortir,
			'status' => $status,
			'items' => $this->prepareData($limit, $sortir, $status)->get(),
		);

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);
        return $result;
	}

	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null)
	{
		$page 	= $this->repoPage($page);
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|page:'.$page .'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$data 	= $this->prepareData($limit, $sortir, $status);
		$result = array(
			'total'	=> $data->count(),
			'page' 	=> $page,
			'limit'	=> $limit,
			'sortir' => $sortir,
			'status' => $status,
		);
		$result['items'] = $data->skip( $limit * ($page-1) )
	                ->take($limit)
	                ->get();

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);

		return $result;
	}

	public function getById($id)
	{
		// check cache
		$key = __FUNCTION__.'|id:'.$id;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag( $tag )->get($key) ) return $get;

		$result = $this->model->find($id);

		// save cache
		if($result) $this->cacheTag( $tag )->forever($key, $result);

		return $result;
	}

	public function getByUsername($username)
	{
		// check cache
		$key = __FUNCTION__.'|username:'.$username;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;
		
		$result = $this->model->where('username', $username)->first();

		// save cache
		if($result) $this->cacheTag($tag)->forever($key, $result);
		return $result;
	}

	public function store($input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		if($this->repoValidation($input))
		{
			return $this->model->create($input);
		}

		return false;
	}

	public function update($id, $input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		$rules = array_merge($this->editRules, $rules);
		if($this->repoValidation($input, $rules))
		{
			$prevData = $this->model->find($id);

			$this->cacheTag( $this->getCacheTag('one') )->forget('getById|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getByUsername|username:'.$prevData['username']);

			$prevData->update($input);
			return true;
		}

		return false;
	}

	public function delete($id, $is_permanent=false)
	{
		if( $prevData = $this->model->find($id) )
		{
			$this->cacheTag( $this->getCacheTag('one') )->forget('getById|id:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getByUsername|username:'.$prevData['username']);

			if($is_permanent)
				$prevData->forceDelete();
			else
				$prevData->delete();

			return true;
		}
		return false;
	}

	public function auth()
	{
		// check cache
		$key = __FUNCTION__. \Session::get('currentUserId');
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = \Auth::user();

		// save cache
		if($result) $this->cacheTag($tag)->forever($key, $result);
		return $result;
	}

	public function login($input=array())
	{
		if (\Auth::attempt( array('email' => Input::get('email'), 'password' => Input::get('password')), Input::get('remember') ))
		{
			\Session::put('currentUserId', \Auth::user()->id);
		    return true;
		}
		return false;
	}

	public function logout()
	{
		// flush all cache
		\Session::flush();
		// delete cache
		$this->cacheTag( $this->getCacheTag('one') )->forget('auth'. \Session::get('currentUserId'));
		return \Auth::logout();
	}

}