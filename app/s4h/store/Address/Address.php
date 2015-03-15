<?php namespace s4h\store\Address;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
 * 
 */
 class Address extends Eloquent{

 	protected $table = 'address';

 	public function classified(){
		return $this->hasOne('s4h\store\Classifieds\Classified','address_id');
	}

	public function city(){
		return $this->belongsTo('s4h\store\Cities\City','city_id');
	}

	public function people(){
		return $this->hasOne('s4h\store\Peoples\People','address_id');
	}

 } 