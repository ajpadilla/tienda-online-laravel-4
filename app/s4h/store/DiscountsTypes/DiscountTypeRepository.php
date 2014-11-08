<?php namespace s4h\store\DiscountsTypes;

use s4h\store\DiscountsTypes\DiscountType;

class DiscountTypeRepository {

	public function save(DiscountType $discountType){
		return $discountType->save();
	}

	public function getAll(){
		return DiscountType::all();
	}

	
}