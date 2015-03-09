<?php namespace s4h\store\Address;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
 * 
 */
 class Address extends Eloquent{

 	protected $table = 'address';

 	public function Classified(){
		return $this->hasOne('s4h\store\Classifieds\Classified','address_id');
	}

 } 