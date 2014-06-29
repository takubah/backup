<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class WidgetItem extends EloquentBase {
	
	protected $table = 'widgets_items';

	/**
    * Morph relation name
    */
	protected $morphClass = 'Antoniputra\Asmoyo\Widgets\WidgetItem';

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
	protected $fillable = array('widget_id', 'widget_group_id', 'parent_id', 'order', 'title', 'content');

	/**
    * These are make collumn to Carbon instance
    * @return array
    */
	public function getDates()
    {
        return array('created_at', 'updated_at');
    }
	
	/**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'widget_group_id'   => 'required_without:widget_id',
            'content'           => 'required',
        );
    }



}