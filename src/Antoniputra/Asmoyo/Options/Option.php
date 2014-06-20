<?php namespace Antoniputra\Asmoyo\Options;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Option extends EloquentBase {
	
	protected $table = 'options';

	protected $fillable = array('name', 'value', 'description', 'type');

}