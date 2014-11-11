<?php namespace s4h\store\Discounts;

use s4h\store\Discounts\Discount;

class DiscountRepository {

	public function save(Discount $discount){
		return $discount->save();
	}

	public function getAll(){
		return Discount::all();
	}

	public function createNewDiscount($data = array())
	{
		$discount = new Discount;
		$discount->value = $data['value'];
		$discount->percent = $data['percent'];
		$discount->quantity = $data['quantity'];
		$discount->quantity_per_user = $data['quantity_per_user'];
		$discount->code = $data['code'];
		$discount->active = $data['active'];
		$discount->from = date("Y-m-d",strtotime($data['from']));
		$discount->to = date("Y-m-d",strtotime($data['from']));
		$discount->discount_type_id = $data['discount_type_id'];
		$discount->save();
		$discount->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
	}

	public function getCode($code)
	{
		return Discount::where('code','=',$code)->get();
	}
}