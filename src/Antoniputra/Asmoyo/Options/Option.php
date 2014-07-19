<?php namespace Antoniputra\Asmoyo\Options;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Option extends EloquentBase {
	
	protected $table = 'options';

	/**
	* Disabled timestamps
	*/
	public $timestamps = false;

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

	public function getValueAttribute($value)
    {
    	if( $this->getAttributes()['type'] == 'json') {
        	return json_decode($value, true);
    	}
    	return $value;
    }
}