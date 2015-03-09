<?php namespace s4h\store\Peoples;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class People extends Eloquent{
	protected $table = 'people';

	public function user() {
		return $this->hasOne('s4h\store\Users\User');
	}
}
