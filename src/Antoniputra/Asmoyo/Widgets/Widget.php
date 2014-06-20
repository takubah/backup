<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Widget extends EloquentBase {
	
	protected $table = 'widgets';

	protected $fillable = array('objectable_id', 'objectable_type', 'title', 'description', 'content', 'view_path', 'is_hasMany', 'status');

}