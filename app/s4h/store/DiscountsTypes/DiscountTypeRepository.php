<?php namespace s4h\store\DiscountsTypes;

use s4h\store\DiscountsTypes\DiscountType;
use s4h\store\Languages\Language;
use s4h\store\DiscountTypesLang\DiscountTypeLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DiscountTypeRepository {

	public function save(DiscountType $discountType){
		return $discountType->save();
	}

	public function getAll(){
		return DiscountType::all();
	}

	public function getName($data)
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->discounts_types()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}
	
	public function getNameForLanguage()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		return $language->discounts_types()->lists('name','discount_type_id');
	}

	public function createNewDiscountType($data = array())
	{
		$discount_type = new DiscountType;
		$discount_type->save();
		$discount_type->languages()->attach($data['language_id'], array('name'=> $data['name']));	
	}

	public function getDiscountTypeId($discount_type_id)
	{
		return DiscountType::find($discount_type_id);
	}
}