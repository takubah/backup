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
		$status = $this->repoStatus($status);

		$data = $this->prepareData($limit, $sortir, $status)->with('items');
		$result = array(
			'total'	=> $data->count(),
			'page' 	=> $page,
			'limit'	=> $limit,
			'sortir' => $sortir,
			'status' => $status,
			'items' => $data->get(),
		);
        return $result;
	}

	public function getById($id)
	{

	}

	public function getBySlug($slug)
	{

	}

	public function getWidgetPath()
	{

	}

}