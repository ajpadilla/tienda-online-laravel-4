<?php namespace s4h\store\Cities;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class City extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'cities';


	public function address(){
		return $this->hasMany('s4h\store\Address\Address','city_id');
	}

}