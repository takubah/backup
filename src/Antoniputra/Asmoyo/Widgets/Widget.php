<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Widget extends EloquentBase {
	
	public $table = 'widgets';

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
    protected $fillable = array();

	/**
    * These are make collumn to Carbon instance
    * @return array
    */
	public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at');
    }

    /**
    * These are additional attribute
    */
    protected $appends = array('url');

    public function getUrlAttribute()
    {
        return route('admin.widget.show', $this->slug);
    }

    public function getAttributeAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setAttributeAttribute($value)
    {
        $this->attributes['attribute'] = json_encode($value);
    }
	
	/**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'title'         => 'required',
            'slug'          => 'required',
            'description'   => 'required',
            'supported'     => 'required',
            'has_item'      => 'required',
            'attribute'     => 'required',
            // 'view_path'		=> 'required',
        );
    }

    public function items()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Widgets\WidgetItem');
    }

    public function item()
    {
        return $this->hasOne('Antoniputra\Asmoyo\Widgets\WidgetItem');
    }

}