<?php namespace Antoniputra\Asmoyo\Pages;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Page extends EloquentBase {
	
	protected $table = 'pages';

	protected $fillable = array('parent_id', 'status', 'title', 'url', 'content', 'side_left', 'side_right', 'footer', 'meta_title', 'meta_keyword', 'meta_description');

}