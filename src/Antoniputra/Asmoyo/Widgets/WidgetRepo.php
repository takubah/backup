<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\RepoBase;

class WidgetRepo extends RepoBase implements WidgetInterface
{
	
	public function __construct(Widget $model, WidgetGroup $widgetGroup, WidgetItem $widgetItem)
	{
		$this->model = $model;
		$this->widgetGroup 	= $widgetGroup;
		$this->widgetItem 	= $widgetItem;
	}

	protected function getCacheTag($key = 'one')
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
		// $key = __FUNCTION__.'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		// $tag = $this->getCacheTag('many');
		// if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = $this->prepareData($limit, $sortir, $status)->with('groups.items')->get();

		// save cache
        // if($result['items']) $this->cacheTag($tag)->forever($key, $result);
        return $result;
	}
	
	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null)
	{
		$page 	= $this->repoPage($page);
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		// $key = __FUNCTION__.'|page:'.$page .'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		// $tag = $this->getCacheTag('many');
		// if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$data = $this->prepareData($limit, $sortir, $status)->with('groups');
		$result = array(
			'total'	=> $data->count(),
			'page'	=> $page,
			'limit'	=> $limit,
			'sortir' => $sortir,
			'status' => $status,
			'items' => $data->get(),
		);

		// save cache
        // if($result['items']) $this->cacheTag($tag)->forever($key, $result);
        return $result;
	}

	public function getById($id)
	{
		return $this->model->with('groups.items')->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->with('groups.items')
			->where('slug', $slug)->first();
	}

	public function enable($id)
	{
		return $this->model->find($id)->update(array('status' => 'enabled'));
	}

	public function disable($id)
	{
		return $this->model->find($id)->update(array('status' => 'disabled'));
	}


	// Group

	public function getGroupAll()
	{
		return $this->widgetGroup->with('widget', 'items')->get();
	}

	public function getGroupAllPaginated()
	{
		return $this->widgetGroup->with('widget', 'items')->get();
	}

	public function getGroupBySlug($group_slug)
	{
		return $this->widgetGroup->with('widget', 'items')->where('slug', $group_slug)->first();
	}

}