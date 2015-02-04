<?php namespace s4h\store\Users;

use Zizaco\Confide\ConfideUser;
use Zizaco\Entrust\HasRole;

class User extends ConfideUser {

	use HasRole;

	//protected $table = 'users';

	protected $dates = ['deleted_at'];

	public function userdetail()
	{
		return $this->hasOne('Userdetail');
	}

	public function familie()
	{
		return $this->hasOne('Familie');
	}

	public function calendars()
	{
		return $this->hasMany('Calendar');
	}

	public function Person() {
		return $this->hasOne('Person');
	}
}