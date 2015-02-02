<?php namespace s4h\store\States;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class State extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'states';

	public function cities(){
		return  $this->hasMany('s4h\store\Cities\City','states_id');
	}
}