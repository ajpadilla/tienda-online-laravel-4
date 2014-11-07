<?php namespace s4h\store\Discounts_types;

use s4h\store\Discounts_types\DiscountType;

class DiscountTypeRepository {

	public function save(DiscountType $discountType){
		return $discountType->save();
	}

	public function getAll(){
		return DiscountType::all();
	}

	
}