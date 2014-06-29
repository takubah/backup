<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class User extends EloquentBase {
	
	protected $table = 'users';

	/**
    * Morph relation name
    */
	protected $morphClass = 'Antoniputra\Asmoyo\Users\User';

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
	protected $fillable = array('email', 'username', 'password', 'permissions', 'last_login', 'remember_token', 'persist_code', 'reset_password_code', 'media_id', 'fullname', 'birthday', 'gender', 'city', 'address');

	/**
    * These are make collumn to Carbon instance
    * @return array
    */
	public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at');
    }
	
	/**
    * Default validation rules
    */
    public function defaultRules()
    {
        return array(
            'email'         => 'required',
            'username'		=> 'required',
            'password'		=> 'required|confirmed|min:6',
            'fullname'		=> 'required',
            'birthday'		=> 'required',
            'gender'		=> 'required',
            'city'			=> 'required',
            'address'		=> 'required',
        );
    }
}