<?php namespace Antoniputra\Asmoyo\Pages;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Page extends EloquentBase {
	
	protected $table = 'pages';

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
	protected $fillable = array('parent_id', 'status', 'title', 'url', 'content', 'side_left', 'side_right', 'footer', 'order','meta_title', 'meta_keyword', 'meta_description');

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
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'title'         => 'required',
            'url'			=> 'required',
            'content'		=> 'required',
            'status'        => 'required|in:'.implode(',', $this->statusList),
        );
    }

}