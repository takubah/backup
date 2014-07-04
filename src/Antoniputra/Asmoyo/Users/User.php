<?php namespace Antoniputra\Asmoyo\Users;

use Illuminate\Auth\UserInterface as LaravelUserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Antoniputra\Asmoyo\Cores\EloquentBase;

class User extends EloquentBase implements LaravelUserInterface, RemindableInterface {
	
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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

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