<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class WidgetGroup extends EloquentBase {
	
	protected $table = 'widgets_groups';

	/**
    * Morph relation name
    */
	protected $morphClass = 'Antoniputra\Asmoyo\Widgets\WidgetGroup';

    /**
    * Soft delete active
    */
    protected $softDelete = true;

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
	protected $fillable = array('widget_id', 'type', 'title', 'slug', 'description');

	/**
    * These are make collumn to Carbon instance
    * @return array
    */
	public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at');
    }

    /**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'widget_id'         => 'required',
            'title'             => 'required',
            'slug'              => 'required',
            'description'       => 'required',
        );
    }

    public function widget()
    {
        return $this->belongsTo('Antoniputra\Asmoyo\Widgets\Widget');
    }

    public function items()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Widgets\WidgetItem');
    }

}