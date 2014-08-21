<?php namespace Antoniputra\Asmoyo\Medias;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Media extends EloquentBase
{
	
	protected $table = 'medias';

    /**
    * Morph relation name
    */
	protected $morphClass = 'media';

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
    protected $fillable = array('gallery_id', 'type', 'file', 'mime_type', 'size', 'status', 'title', 'slug', 'description');

	/**
    * These are make collumn to Carbon instance
    * @return array
    */
	public function getDates()
    {
        return array('created_at', 'updated_at');
    }

    /**
    * list type support
    * @var array
    */
    public $typeList = array(
    	'internal', 'external'
	);

    /**
    * list status support
    * @var array
    */
    public $statusList = array(
        'published', 'privated'
    );

    /**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'title'         => 'required|unique:'.$this->table,
            'slug'          => 'required|unique:'.$this->table,
            'type'          => 'required|in:'.implode(',', $this->typeList),
            'file'          => 'required|mimes:jpeg,jpg,gif,png',
            'status'        => 'required|in:'.implode(',', $this->statusList),
        );
    }


	public function category()
    {
        return $this->belongsTo('Antoniputra\Asmoyo\Categories\Category');
    }
}