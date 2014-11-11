<?php namespace s4h\store\Discounts;

use Eloquent;

class Discount extends Eloquent {
	
	protected $table = 'discounts';

	protected $fillable = ['value','percent','quantity','quantity_per_user','code','active','from','to','discount_type_id'];


	public function getActivoShow() {
		return ($this->active == 1) ? 'Yes' : 'No';
	}

	public function discountType(){
		return $this->belongsTo('s4h\store\DiscountsTypes\DiscountType');
	}
}