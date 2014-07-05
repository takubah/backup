<?php

use Antoniputra\Asmoyo\Users\UserInterface;

class Admin_UserController extends AsmoyoController
{
	public function __construct(UserInterface $user)
	{
		$this->user = $user;
	}

	/**
	* Display admin login
	* @return Response
	*/
	public function adminLogin()
	{
		$data = array();
		return $this->loadView('asmoyo::admin.user.login', $data, true);
	}


	/**
	* @return Redirect
	*/
	public function postAdminLogin()
	{
		if (Auth::attempt( array('email' => Input::get('email'), 'password' => Input::get('password')), Input::get('remember') ))
		{
		    return Redirect::route('admin.home.dashboard');
		}

		return Redirect::back()->with('alert', array(
			'type'		=> 'error',
			'message'	=> 'Login Gagal !!'
		))->withInput();
	}


	/**
	* @return Redirect
	*/
	public function adminLogout()
	{
		$this->user->logout();
		return Redirect::route('admin.login');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = array(
			'users'		=> $this->user->getAllPaginated(),
		);
		return $this->loadView('asmoyo::admin.user.index', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array();
		return $this->loadView('asmoyo::admin.user.create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return 'here is store method';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = array(
			'user'		=> $this->user->getBySlug($slug),
		);

		if( ! $data['user'] ) return App::abort(404);

		return 'here is show method';
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array(
			'user'		=> $this->user->getBySlug($slug),
		);

		if( ! $data['user'] ) return App::abort(404);

		return $this->loadView('asmoyo::admin.user.edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = array(
			'user'		=> $this->user->getBySlug($slug),
		);

		if( ! $data['user'] ) return App::abort(404);

		return 'here is update method';
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return 'ini adalah method destroy';
	}


}
