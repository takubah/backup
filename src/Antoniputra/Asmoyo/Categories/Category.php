<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Category extends EloquentBase {
	
	protected $table = 'categories';

	protected $morphClass = 'category';

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
	protected $fillable = array('media_id', 'parent_id', 'title', 'url', 'description', 'type', 'status');


	public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at');
    }

    public function cover()
    {
    	return $this->hasOne('Antoniputra\Asmoyo\Medias\Media');
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