<?php

use Antoniputra\Asmoyo\Posts\PostInterface;

class Admin_PostController extends AsmoyoController
{
	public function __construct(PostInterface $post)
	{
		$this->post = $post;
	}

	public function index()
	{
		$posts = $this->post->getAllPaginated();
		$data = array(
			'posts'		=> Paginator::make($posts, $posts['total'], $posts['limit']),
		);
		return $this->adminView('post.index', $data, true);
	}

	public function create()
	{
		$data = array(
			'categoryList' 	=> app('Antoniputra\Asmoyo\Categories\CategoryInterface')->getAsDropdown(),
			'statusList'	=> $this->post->getStatusList(),
		);
		return $this->adminView('post.create', $data);
	}

	public function store()
	{
		$input = Input::all();
		if ( $this->post->store($input) )
		{
			return $this->redirectAlert('admin.post.index', 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectAlert(false, 'danger', 'Gagal !!', $this->post->errors);
	}

	public function show($slug)
	{
		$data = array(
			'post'		=> $this->post->getBySlug($slug),
		);

		if( ! $data['post'] ) return App::abort(404);

		return 'here is show method';
	}

	public function edit($slug)
	{
		$data = array(
			'post'			=> $this->post->getBySlug($slug),
			'categoryList' 	=> app('Antoniputra\Asmoyo\Categories\CategoryInterface')->getAsDropdown(),
			'statusList'	=> $this->post->getStatusList(),
		);

		if( ! $data['post'] ) return App::abort(404);

		return $this->adminView('post.edit', $data);
	}

	public function update($slug)
	{
		$input = Input::all();
		if ( $this->post->update( $input['id'], $input ) )
		{
			return $this->redirectAlert('admin.post.index', 'success', 'Berhasil Diperbarui !!');
		}

		return $this->redirectAlert(false, 'danger', 'Gagal !!', $this->post->errors);
	}

	public function destroy($id)
	{
		if( $this->post->delete($id) )
		{
			return $this->redirectAlert('admin.post.index', 'success', 'Berhasil Dihapus !!');
		}
		return $this->redirectAlert('admin.post.index', 'danger', 'Gagal Dihapus !!');
	}

	public function forceDelete($id)
	{
		if( $this->post->delete($id, true) )
		{
			return $this->redirectAlert('admin.post.index', 'success', 'Berhasil Dihapus Permanent !!');
		}
		return $this->redirectAlert('admin.post.index', 'danger', 'Gagal Dihapus Permanent !!');
	}
}