<?php namespace s4h\store\Discounts;

use s4h\store\Discounts\Discount;
use s4h\store\languages\LanguageRepository;
use s4h\store\DiscountTypesLang\DiscountTypeLang;
class DiscountRepository {

	public function save(Discount $discount){
		return $discount->save();
	}

	public function getAll(){
		return Discount::all();
	}

	public function associateLanguage($data = array())
	{
		$discount = $this->getCode($data['code']);
		if (count($discount->languages()->where('language_id','=',$data['language_id'])->first()) > 0) {
			return false;
		}else{
			$discount->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
			$discount->save();
			return true;
		}
		
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

	public function updateDiscount($data = array(), $discount_id)
	{
		$discount = Discount::find($discount_id);
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

		$discount_language = $discount->languages()->where('language_id','=',$data['language_id'])->first();
		$discount_language->pivot->name = $data['name'];
		$discount_language->pivot->description = $data['description'];
		$discount_language->pivot->save();
	}

	public function getCode($code)
	{
		return Discount::select()->where('code','=',$code)->first();
	}

	public function getDiscountId($id)
	{
		return Discount::select()->where('id','=',$id)->first();
	}

	public function getCodeEdit($data = array())
	{
		return Discount::select()->where('id','!=',$data['discount_id'])->where('code','=',$data['code'])->first();
	}

	public function deleteDiscount($discount_id)
	{
		$discount = Discount::find($discount_id);
		//$discount->languages()->withTrashed()->get();
		$discount->delete();
	}
}