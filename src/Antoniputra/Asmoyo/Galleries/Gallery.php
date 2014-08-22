<?php namespace Antoniputra\Asmoyo\Galleries;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Gallery extends EloquentBase
{
	
	protected $table = 'galleries';

    /**
    * Morph relation name
    */
	protected $morphClass = 'Antoniputra\Asmoyo\Galleries\Gallery';

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
	protected $fillable = array('media_id', 'title', 'slug', 'description', 'status');

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
        'publish', 'private',
    );

    /**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'title'         => 'required',
            'slug'          => 'required',
            'status'        => 'required|in:'.implode(',', $this->statusList),
        );
    }



    public function cover()
    {
    	return $this->belongsTo('Antoniputra\Asmoyo\Medias\Media', 'media_id');
    }

	public function medias()
	{
        return $this->belongsToMany('Antoniputra\Asmoyo\Medias\Media', 'galleries_medias');
	}

}