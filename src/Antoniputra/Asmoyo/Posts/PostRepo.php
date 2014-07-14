<?php namespace Antoniputra\Asmoyo\Posts;

use Antoniputra\Asmoyo\Cores\RepoBase;

class PostRepo extends RepoBase implements PostInterface
{
	protected $editRules = array(
		'title'		=> 'required|unique:posts,title,<id>',
        'slug'		=> 'required|unique:posts,slug,<id>',
	);

	public function __construct(Post $model)
	{
		parent::__construct($model);
	}

	public function getAll($sortir = null, $limit = null)
	{
		// check cache
		$key = __FUNCTION__.'|sortir:'.$sortir.'|limit:'.$limit;
		if( $get = $this->cacheTag(__CLASS__)->get($key) ) return $get;

		$result = $this->prepareData($sortir, $limit)->with('groupable', 'cover')->get();

		// save cache
		$this->cacheTag(__CLASS__)->forever($key, $result);
		return $result;
	}

	public function getAllPaginated($sortir = null, $limit = null)
	{
		return $this->prepareData($sortir, $limit)->with('groupable', 'cover')
			->paginate( $this->repoLimit($limit) );
	}

	public function getByType($type='article', $limit=null)
	{
		$type = (in_array( $type, $this->model->typeList )) ? $type : 'article';

		return $this->prepareData()->with('groupable', 'cover')
			->where('type', $type)
			->paginate( $this->repoLimit($limit) );
	}

	public function getById($id)
	{
		return $this->model->with('groupable', 'cover')->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->with('groupable', 'cover')
			->where('slug', $slug)->first();
	}

}