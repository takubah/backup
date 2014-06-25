<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Category extends EloquentBase
{
	
	protected $table = 'categories';

    /**
    * Morph relation name
    */
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
	protected $fillable = array('media_id', 'parent_id', 'title', 'slug', 'description', 'type', 'status');

    /**
    * These are make collumn to Carbon instance
    * @return array
    */
	public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at');
    }

    /**
    * list type support
    * @var array
    */
    public $typeList = array(
        'category', 'gallery'
    );

    /**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'title'         => 'required',
            'slug'          => 'required',
            'type'          => 'required|in:'.implode(',', $this->typeList),
            'status'        => 'required',
        );
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