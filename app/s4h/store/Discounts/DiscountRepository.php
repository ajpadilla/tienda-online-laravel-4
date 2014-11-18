<?php namespace s4h\store\Discounts;

use s4h\store\Discounts\Discount;
use s4h\store\Languages\LanguageRepository;
use s4h\store\DiscountTypesLang\DiscountTypeLang;
use s4h\store\DiscountsLang\DiscountLang;

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
		$discount->to = date("Y-m-d",strtotime($data['to']));
		$discount->discount_type_id = $data['discount_type_id'];
		$discount->save();
		$discount->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
	}

	public function updateDiscount($data = array())
	{
		$discount = $this->getDiscountId($data['discount_id']);
		$discount->value = $data['value'];
		$discount->percent = $data['percent'];
		$discount->quantity = $data['quantity'];
		$discount->quantity_per_user = $data['quantity_per_user'];
		$discount->code = $data['code'];
		$discount->active = $data['active'];
		$discount->from = date("Y-m-d",strtotime($data['from']));
		$discount->to = date("Y-m-d",strtotime($data['to']));
		$discount->discount_type_id = $data['discount_type_id'];
		$discount->save();

		if (count($discount->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$discount->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
		}else{
			$discount->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
		}
		
	}

	public function getCode($code)
	{
		return Discount::select()->where('code','=',$code)->first();
	}

	public function getDiscountId($discount_id)
	{
		return Discount::find($discount_id);
	}

	public function getCodeEdit($data = array())
	{
		return Discount::select()->where('id','!=',$data['discount_id'])->where('code','=',$data['code'])->first();
	}

	public function deleteDiscount($discount_id)
	{
		$discount = $this->getDiscountId($discount_id);
		$discount->delete();
		DiscountLang::where('discount_id','=',$discount_id)->delete();
	}
}