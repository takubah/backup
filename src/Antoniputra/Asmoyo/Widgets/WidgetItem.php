<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class WidgetItem extends EloquentBase {
	
	public $table = 'widgets_items';

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
    protected $fillable = array();

    /**
    * These are make collumn to Carbon instance
    * @return array
    */
	public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at');
    }

    public function getContentAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = json_encode($value);
    }

    /**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
        	'widget_id'		=> 'required',
        	'title'			=> 'required',
        	'description'	=> 'required',
        	'content'		=> 'required'
    	);
	}
	

    public function widget()
    {
        return $this->belongsTo('Antoniputra\Asmoyo\Widgets\Widget');
    }
}