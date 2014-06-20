<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Category extends EloquentBase {
	
	protected $table = 'categories';

	protected $fillable = array('media_id', 'parent_id', 'title', 'url', 'description', 'type', 'status');

}