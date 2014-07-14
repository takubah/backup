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
	protected $fillable = array('parent_id', 'status', 'type', 'structure', 'title', 'slug', 'content', 'side_left', 'side_right', 'footer', 'order','meta_title', 'meta_keyword', 'meta_description');

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
        'published', 'privated', 'drafted'
    );

    /**
    * list type support
    * @var array
    */
    public $typeList = array(
        'standard', 'category', 'post'
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
            'title'         => 'required|unique:'.$this->table,
            'slug'			=> 'required|unique:'.$this->table,
            'content'		=> 'required',
            'status'        => 'required|in:'.implode(',', $this->statusList),
        );
    }

}