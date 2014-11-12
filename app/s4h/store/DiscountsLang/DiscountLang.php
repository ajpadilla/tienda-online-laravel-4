<?php namespace s4h\store\DiscountsLang;

use Eloquent;

/**
* 
*/
class DiscountLang extends Eloquent{
	protected $table = 'discounts_lang';

	public function discount(){
		return $this->belongsTo('s4h\store\Discounts\Discount','discount_id');
	}
}
