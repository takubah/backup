<?php namespace Antoniputra\Asmoyo\Pages;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Page extends EloquentBase {
	
	public $table = 'pages';

	/**
    * Morph relation name
    */
	protected $morphClass = 'Antoniputra\Asmoyo\Pages\Page';

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
	protected $fillable = array('parent_id', 'status', 'type', 'structure', 'order', 'title', 'slug', 'content', 'content_structure', 'side_left', 'side_right', 'footer', 'meta_title', 'meta_keyword', 'meta_description');

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

    public function getContentStructureAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setContentStructureAttribute($value)
    {
        $this->attributes['content_structure'] = json_encode($value);
    }

    public function getSideLeftAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setSideLeftAttribute($value)
    {
        $this->attributes['side_left'] = json_encode($value);
    }

    public function getSideRightAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setSideRightAttribute($value)
    {
        $this->attributes['side_right'] = json_encode($value);
    }

    // custom attribute
    public function getUrlAttribute()
    {
        return route('page.show', $this->slug);
    }

    /**
    * list status support
    * @var array
    */
    public $statusList = array(
        'published', 'privated', 'drafted'
    );

    /**
    * list type support
    * @var array
    */
    public $typeList = array(
        'default', 'standard', 'category', 'post'
    );

    /**
    * list structure
    * @var array
    */
    public $structureList = array(
        'oneCollumn', 'twoCollumn', 'threeCollumn',
    );
	
	/**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'parent_id'     => 'integer',
            'title'         => 'required|unique:'.$this->table,
            'slug'			=> 'required|unique:'.$this->table,
            'content'		=> 'required',
            'status'        => 'required|in:'.implode(',', $this->statusList),
            'type'          => 'required|in:'.implode(',', $this->typeList),
            'structure'     => 'required|in:'.implode(',', $this->structureList),
        );
    }

}