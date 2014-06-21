<?php namespace Antoniputra\Asmoyo\Options;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Option extends EloquentBase {
	
	protected $table = 'options';

	/**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array();

    /**
     * These are the mass-assignable keys
     * @var array
     */
	protected $fillable = array('name', 'value', 'description', 'type');

	public $rules = array(
		'name'			=> 'required',
		'value'			=> 'required',
		'description'	=> 'required',
	);
}