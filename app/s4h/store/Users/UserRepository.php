<?php namespace s4h\store\Users;

use s4h\store\Users\User;
/**
*
*/
class UserRepository {

	public function get($id)
	{
		return User::findOrFail($id);
	}

	public function getAll()
	{
		return User::all();
	}
}