<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Category extends EloquentBase
{
	
	public $table = 'categories';

    /**
    * Morph relation name
    */
	protected $morphClass = 'Antoniputra\Asmoyo\Categories\Category';

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
    * list status support
    * @var array
    */
    public $statusList = array(
        'published', 'privated',
    );

    /**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'title'         => 'required|unique:'.$this->table,
            'slug'          => 'required|unique:'.$this->table,
            'media_id'      => 'integer',
            'parent_id'     => 'integer',
            'status'        => 'required|in:'.implode(',', $this->statusList),
        );
    }



    public function cover()
    {
    	return $this->belongsTo('Antoniputra\Asmoyo\Medias\Media', 'media_id');
    }

	public function medias()
	{
		return $this->hasMany('Antoniputra\Asmoyo\Medias\Media');
	}

	public function posts()
	{
		return $this->morphMany('Antoniputra\Asmoyo\Posts\Post', 'groupable');
	}

}