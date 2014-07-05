<?php namespace Antoniputra\Asmoyo\Comments;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class Comment extends EloquentBase {
	
	protected $table = 'comments';

	/**
    * Morph relation name
    */
	protected $morphClass = 'Antoniputra\Asmoyo\Comments\Comment';

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
	protected $fillable = array('groupable_id', 'groupable_type', 'user_id',  'title', 'content', 'status', 'anonymous_name', 'anonymous_email', 'anonymous_url', 'anonymous_agent');

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
        'object', 'message'
    );

    /**
    * list status support
    * @var array
    */
    public $statusList = array(
        'pending', 'published', 'privated'
    );
    
    /**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'title'             => 'required',
            'content'           => 'required',
            'anonymous_name'    => 'required_without:user_id',
            'anonymous_email'   => 'required_without:user_id',
            'anonymous_url'     => 'required_without:user_id',
            'anonymous_agent'   => 'required_without:user_id',
            'type'              => 'required|in:'.implode(',', $this->typeList),
            'status'            => 'required|in:'.implode(',', $this->statusList),
        );
    }

    public function objectable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Antoniputra\Asmoyo\Users\User', 'user_id');
    }
}