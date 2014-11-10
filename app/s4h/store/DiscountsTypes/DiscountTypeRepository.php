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

	public function getName($name)
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		$discount_type = DiscountTypeLang::select()->where('language_id', '=' , $language->id)
					->where('name','=',$name)
					->get();
		return $discount_type;
	}
	
	public function createNewDiscountType($data = array())
	{
		$discount_type = new DiscountType;
		$discount_type->save();
		$discount_type->languages()->attach($data['language_id'], array('name'=> $data['name']));	
	}

}