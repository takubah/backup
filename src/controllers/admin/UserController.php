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
		if ($this->user->login(Input::all()))
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
		$users = $this->user->getAllPaginated();
		$data = array(
			'users'		=> Paginator::make($users, $users['total'], $users['limit']),
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
	public function show($username)
	{
		$data = array(
			'user'		=> $this->user->getByUsername($username),
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
	public function edit($username)
	{
		$data = array(
			'user'		=> $this->user->getByUsername($username),
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
		$input = Input::all();
		if ( $this->user->update( $input['id'], $input) )
		{
			return $this->redirectAlert('admin.user.index', 'success', 'Berhasil Diperbarui !!');
		}

		return $this->redirectAlert(false, 'danger', 'Gagal !!', $this->user->errors);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if( $this->user->delete($id) )
		{
			return $this->redirectAlert('admin.user.index', 'success', 'Berhasil Dihapus !!');
		}

		return $this->redirectAlert('admin.user.index', 'danger', 'Gagal Dihapus !!');
	}


}