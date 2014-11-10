<?php namespace s4h\store\DiscountsTypes;

use s4h\store\DiscountsTypes\DiscountType;

class DiscountTypeRepository {

	public function save(DiscountType $discountType){
		return $discountType->save();
	}

	public function getAll(){
		return DiscountType::all();
	}

	
	public function createNewDiscountType($data = array())
	{
		$discount_type = new DiscountType;
		$discount_type->save();
		$discount_type->languages()->attach($data['language_id'], array('name'=> $data['name']));	
	}
}