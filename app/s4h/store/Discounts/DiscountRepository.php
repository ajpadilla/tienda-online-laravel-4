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
		$discount->name = $data['name'];
		$discount->description = $data['description'];
		$discount->value = $data['value'];
		$discount->percent = $data['percent'];
		$discount->quantity = $data['quantity'];
		$discount->quantity_per_user = $data['quantity_per_user'];
		$discount->code = $data['code'];
		$discount->active = $data['active'];
		$discount->from = $data['from'];
		$discount->to = $data['to'];
		$discount->discount_type_id = $data['discount_type_id'];
		$this->save($discount);
	}
}