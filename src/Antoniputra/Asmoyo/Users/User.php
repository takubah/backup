<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\EloquentBase;

class User extends EloquentBase {
	
	protected $table = 'users';

	protected $fillable = array('email', 'username', 'password', 'permissions', 'last_login', 'remember_token', 'persist_code', 'reset_password_code', 'media_id', 'fullname', 'birthday', 'gender', 'city', 'address');

}