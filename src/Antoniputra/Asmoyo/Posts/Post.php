<?php namespace Antoniputra\Asmoyo\Posts;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Post extends EloquentBase {
	
	protected $table = 'posts';

	/**
    * Morph relation name
    */
	protected $morphClass = 'post';

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
	protected $fillable = array('groupable_id', 'groupable_type', 'media_id', 'user_id', 'type', 'title', 'slug', 'description', 'body', 'status', 'meta_title', 'meta_keyword', 'meta_description');

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
        'article', 'audio', 'video', 'product'
    );

    /**
    * list status support
    * @var array
    */
    public $statusList = array(
        'published', 'privated', 'drafted', 'scheduled'
    );
	
	/**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'title'         => 'required',
            'slug'			=> 'required',
            'description'	=> 'required',
            'body'			=> 'required',
            'type'          => 'required|in:'.implode(',', $this->typeList),
            'status'        => 'required|in:'.implode(',', $this->statusList),
        );
    }

    public function groupable()
    {
    	return $this->myMorphTo('Antoniputra\Asmoyo\Categories\Category');
    }

    public function category()
    {
    	return $this->belongsTo('Antoniputra\Asmoyo\Categories\Category', 'groupable_id');
    }

    public function scopePostCategory($query)
    {
    	return $query->where('groupable_type', 'category')->with('category');
    }

}