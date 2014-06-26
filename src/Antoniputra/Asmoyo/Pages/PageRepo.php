<?php namespace Antoniputra\Asmoyo\Pages;

use Closure, Config, Cache;
use Antoniputra\Asmoyo\Cores\RepoBase;

class PageRepo extends RepoBase implements PageInterface
{
	
	public function __construct(Page $model)
	{
		parent::__construct($model);
		$this->model 		= $model;
		$this->cacheObjTag 	= $this->repoCacheTag( get_class() );
	}

	public function getAll($limit=null)
	{
		return $this->model->orderBy('order', 'asc')->get();
	}

	public function getById($id)
	{
		return $this->model->find($id);
	}

	public function getBySlug($slug)
	{
		return $this->model->where('slug', $slug)->first();
	}

	public function getAsMenu($parent=0, Closure $el = null)
	{
		if( $el )
		{
			$html = $el();
		} else {
			$html = '<ul>';
		}

		// check cache
		if($cachedResult = $this->cacheGet($cacheKey))
		{
			return ( !$key ) ? $cachedResult : $cachedResult[$key];
		}

		// PEE.ER
	    // $query = $this->model->where('parent_id', $parent)->get();
	    // foreach ($query as $row)
	    // {
	    //     $current_id = $row['id'];
	        
	    //     if()
	    //     	$html 	.= '<li>';
	    //     else
	    //     	$html 	.= '<li class="'.$el["active_class"].'">';

	    //     $html 	.= $row['title'];
	    //     $has_sub = NULL;
	    //     $has_sub = $this->model->where('parent_id', $current_id)->count();
	    //     if($has_sub)
	    //     {
	    //         $html .= $this->getAsMenu($current_id);
	    //     }
	    //     $html .= '</li>';
	    // }
	    // $html .= '</ul>';

	    // save item to cache
		return $this->cacheStore($cacheKey, $result);
	}

}