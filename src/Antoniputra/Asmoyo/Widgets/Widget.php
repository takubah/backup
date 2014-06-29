<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Widget extends EloquentBase {
	
	protected $table = 'widgets';

	/**
    * Morph relation name
    */
	protected $morphClass = 'Antoniputra\Asmoyo\Widgets\Widget';

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
	protected $fillable = array('title', 'slug', 'description', 'content', 'view_path', 'is_hasMany', 'status');

	/**
    * These are make collumn to Carbon instance
    * @return array
    */
	public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at');
    }

    /**
    * list status support
    * @var array
    */
    public $statusList = array(
        'enabled', 'disabled'
    );
	
	/**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'title'         => 'required',
            'slug'          => 'required',
            'description'   => 'required',
            'content'   	=> 'required_without:is_hasMany',
            'view_path'		=> 'required',
            'status'        => 'required|in:'.implode(',', $this->statusList),
        );
    }

    public function groups()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Widgets\WidgetGroup');
    }

}