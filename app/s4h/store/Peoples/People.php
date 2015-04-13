<?php namespace s4h\store\Peoples;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class People extends Eloquent{
	protected $table = 'people';

	public function user() {
		return $this->belongsTo('s4h\store\Users\User','user_id');
	}

	public function address(){
		return $this->belongsTo('s4h\store\Address\Address','address_id');
	}

	public function currency()
	{
		return $this->belongsTo('s4h\store\Currencies\Currency', 'currency_id');
	}
}
