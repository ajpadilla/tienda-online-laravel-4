<?php namespace s4h\store\Discounts_types;

use s4h\store\Discounts_types\Discount_type;

class DiscountTypeRepository {

	public function save(Discount_type $discount_type){
		return $discount_type->save();
	}

}