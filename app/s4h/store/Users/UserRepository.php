<?php namespace s4h\store\Users;

use s4h\store\Users\User;
use s4h\store\Languages\Language;

/**
* 
*/
class UserRepository {
	
	public function getAll()
	{
		return User::all();
	}
}