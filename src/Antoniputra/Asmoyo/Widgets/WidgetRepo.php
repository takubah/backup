<?php namespace Antoniputra\Asmoyo\Widgets;

use Input;
use Antoniputra\Asmoyo\Cores\RepoBase;

class WidgetRepo extends RepoBase implements WidgetInterface
{
	public function __construct(Widget $model, WidgetItem $widgetItem)
	{
		$this->model 		= $model;
		$this->widgetItem 	= $widgetItem;
	}

	public function getAll($limit = null, $sortir = null, $status = null)
	{
		return 'testing cok';
	}

	public function getAllPaginated($page = null, $limit = null, $sortir = null, $status = null)
	{
		$page 	= $this->repoPage($page);
		$limit 	= $this->repoLimit($limit);
		$sortir = $this->repoSortir($sortir);

		$data = $this->prepareData($limit, $sortir, $status)->with('items');
		$result = array(
			'total'	=> $data->count(),
			'page' 	=> $page,
			'limit'	=> $limit,
			'sortir' => $sortir,
			'items' => $data->get(),
		);
        return $result;
	}

	public function getById($id, $itemId = null)
	{

	}

	public function getBySlug($slug, $itemId = null)
	{
		$result = $this->model->where('slug', $slug);
		
		if($itemId)
		{
			$result = $result->with(array('item' => function($query) use($itemId) {
				return $query->find($itemId);
			}));
		} else {
			$result = $result->with('items');
		}

		return $result->first();
	}

	public function itemStore($input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		if($this->repoValidation( $input, $rules, $this->widgetItem->defaultRules() ))
		{
			return $this->widgetItem->create($input);
		}
		return false;
	}

	public function itemUpdate($itemId, $input = array(), $rules = array())
	{
		$input = $input ?: Input::all();
		if($this->repoValidation( $input, $rules, $this->widgetItem->defaultRules() ))
		{
			return $this->widgetItem->find($itemId)->update($input);
		}
		return false;
	}

	public function itemDelete($itemId, $is_permanent=false)
	{
		$prevData = $this->widgetItem->find($itemId);

		if($is_permanent)
			$prevData->forceDelete();
		else
			$prevData->delete();

		return true;
	}

}