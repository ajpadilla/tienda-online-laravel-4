<?php namespace s4h\store\Discounts;

use s4h\store\Discounts\Discount;

class DiscountRepository {

	public function save(Discount $discount){
		return $discount->save();
	}

}