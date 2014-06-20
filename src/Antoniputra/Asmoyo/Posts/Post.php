<?php namespace Antoniputra\Asmoyo\Posts;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Post extends EloquentBase {
	
	protected $table = 'posts';

	protected $fillable = array('groupable_id', 'groupable_type', 'media_id', 'user_id', 'type', 'title', 'url', 'description', 'body', 'status', 'meta_title', 'meta_keyword', 'meta_description');

}