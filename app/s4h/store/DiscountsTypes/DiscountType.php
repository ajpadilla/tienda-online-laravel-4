<?php namespace s4h\store\DiscountsTypes;

use Eloquent;

class DiscountType extends Eloquent {
	
	protected $table = 'discounts_types';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','discount_type_id','evento_id','language_id')->withPivot('name');
	}	
}