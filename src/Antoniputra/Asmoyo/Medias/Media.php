<?php namespace Antoniputra\Asmoyo\Medias;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Media extends EloquentBase {
	
	protected $table = 'medias';

	protected $fillable = array('category_id', 'type', 'file', 'mime_type', 'size', 'title', 'description');

}