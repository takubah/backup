<?php namespace Antoniputra\Asmoyo\Widgets;

use Input;
use Antoniputra\Asmoyo\Cores\RepoBase;

class WidgetRepo extends RepoBase implements WidgetInterface
{
	protected $groupEditRules = array(
		'widget_id'	=> '',
		'title'		=> 'required|unique:widgets_groups,title,<id>',
        'slug'		=> 'required|unique:widgets_groups,slug,<id>',
	);
	
	public function __construct(Widget $model, WidgetGroup $widgetGroup, WidgetItem $widgetItem)
	{
		$this->model 		= $model;
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
		$key = __FUNCTION__.'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = array(
			'limit' => $limit,
			'sortir' => $sortir,
			'status' => $status,
			'items' => $this->prepareData($limit, $sortir, $status)
				->with('groups')
				->get(),
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
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);
        return $result;
	}

	public function getById($id)
	{
		return $this->model->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->where('slug', $slug)->first();
	}

	public function getBySlugWithGroups($slug)
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


	/**
	* Widget Group
	*/

	public function getGroupAll($widgetId, $limit = null, $sortir = null, $status = null)
	{
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);

		// check cache
		$key = __FUNCTION__.'|widgetId:'.$widgetId .'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$result = array(
			'limit' => $limit,
			'sortir' => $sortir,
			'status' => $status,
			'items' => $this->prepareData($limit, $sortir, $status, $this->widgetGroup)
				->where('widget_id', $widgetId)
				->get(),
		);

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);
        return $result;
	}

	public function getGroupAllPaginated($widgetId, $page = null, $limit = null, $sortir = null, $status = null)
	{
		$page 	= $this->repoPage($page);
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);
		$status = $this->repoStatus($status);
		
		// check cache
		$key = __FUNCTION__ .'|widgetId:'.$widgetId .'|page:'.$page .'|limit:'.$limit .'|sortir:'.$sortir .'|status:'.$status;
		$tag = $this->getCacheTag('many');
		if( $get = $this->cacheTag($tag)->get($key) ) return $get;

		$data = $this->prepareData($limit, $sortir, $status, $this->widgetGroup)
			->where('widget_id', $widgetId);

		$result = array(
			'total'	=> $data->count(),
			'page'	=> $page,
			'limit'	=> $limit,
			'sortir' => $sortir,
			'status' => $status,
			'items' => $data->get(),
		);

		// save cache
        if($result['items']) $this->cacheTag($tag)->forever($key, $result);
        return $result;
	}

	public function getGroupById($groupId)
	{
		// check cache
		$key = __FUNCTION__.'|groupId:'.$groupId;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag( $tag )->get($key) ) return $get;

		$result = $this->widgetGroup->with('items')->find($groupId);

		// save cache
		if($result) $this->cacheTag( $tag )->forever($key, $result);
		return $result;
	}

	public function getGroupBySlug($groupSlug)
	{
		// check cache
		$key = __FUNCTION__.'|groupSlug:'.$groupSlug;
		$tag = $this->getCacheTag('one');
		if( $get = $this->cacheTag( $tag )->get($key) ) return $get;

		$result = $this->widgetGroup->with('items')->where('slug', $groupSlug)->first();

		// save cache
		if($result) $this->cacheTag( $tag )->forever($key, $result);
		return $result;
	}

	public function groupStore($widgetId, $input = array(), $rules = array())
	{
		// get widget
		$widget 	= $this->getById($widgetId);
		$fields  	= array_keys($widget['attribute']['field']);
		$custom_rules = array_merge($widget['attribute']['validation'], $rules);
		$base_rules = $this->widgetGroup->defaultRules();
		$input 		= $input ?: Input::all();

		// foreach widget field / item
		foreach ($input['content'][$fields[0]] as $key => $value) {
			$result[$key] = array();
			foreach ($fields as $field) {
				$data[$field] = $input['content'][$field][$key];
			}
			// validation per field / item
			if( ! $this->repoValidation($data, array(), $custom_rules) ) {
				return false;
			}
			// save to $result
			$result[$key] = $data;
		}

		$attr = array(
			'widget_id'	=> $input['widget_id'],
			'title' 	=> $input['title'],
			'slug'		=> \Str::slug($input['title']),
			'type'	 	=> Input::get('type') ?: '',
			'description' => $input['description'],
			'content' 	=> $result,
		);

		if( $this->repoValidation($attr, array(), $base_rules) )
		{
			$this->widgetGroup->create($attr);
			$this->cacheFlush( $this->getCacheTag('many') );
			return true;
		}
		return false;
	}

	public function groupUpdate($widgetId, $groupId, $input = array(), $rules = array())
	{
		// get widget
		$widget 	= $this->getById($widgetId);
		$fields  	= array_keys($widget['attribute']['field']);
		$custom_rules = $widget['attribute']['validation'];

		$input 		= $input ?: Input::all();
		$new_rules 	= array_merge($this->groupEditRules, $rules);

		// foreach widget field / item
		foreach ($input['content'][$fields[0]] as $key => $value) {
			$result[$key] = array();
			foreach ($fields as $field) {
				$data[$field] = $input['content'][$field][$key];
			}
			// validation per field / item
			if( ! $this->repoValidation($data, array(), $custom_rules) ) {
				return false;
			}
			// save to $result
			$result[$key] = $data;
		}

		$attr = array(
			'id'		=> $input['id'],
			'title' 	=> $input['title'],
			'slug'		=> \Str::slug($input['title']),
			'type'	 	=> Input::get('type') ?: '',
			'description' => $input['description'],
			'content' 	=> $result,
		);

		if( $this->repoValidation($attr, $new_rules, $this->widgetGroup->defaultRules()) )
		{
			// get widgetGroup
			$prevData = $this->widgetGroup->find($groupId);

			// clear cache
			$this->cacheTag( $this->getCacheTag('one') )->forget('getGroupById|groupId:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getGroupBySlug|groupSlug:'.$prevData['slug']);
			$this->cacheFlush( $this->getCacheTag('many') );

			$prevData->update($attr);
			return true;
		}
		return false;
	}

	public function groupDelete($groupId, $is_permanent=false)
	{
		if( $prevData = $this->widgetGroup->find($groupId) )
		{
			$this->cacheTag( $this->getCacheTag('one') )->forget('getGroupById|groupId:'.$prevData['id']);
			$this->cacheTag( $this->getCacheTag('one') )->forget('getGroupBySlug|groupSlug:'.$prevData['slug']);
			$this->cacheFlush( $this->getCacheTag('many') );

			if($is_permanent)
				$prevData->forceDelete();
			else
				$prevData->delete();

			return true;
		}
		return false;
	}


	public function getTypeList()
	{
		foreach( $this->widgetGroup->typeList as $t )
		{
			$key = strtolower(str_replace(' ', '', $t));
			$result[$key] = ucfirst($t);
		}
		return $result;
	}

	public function generateFields($fields)
	{
		if(!is_array($fields)) throw new \Exception("fields should be an array", 1);

		$result = array();
		foreach (array_keys($fields) as $key)
		{
			$result[$key]	= '';
		}
		return $result;
	}

}