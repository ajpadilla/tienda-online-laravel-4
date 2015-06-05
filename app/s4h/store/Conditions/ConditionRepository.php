<?php namespace s4h\store\Conditions;


use s4h\store\Conditions\Condition;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;

class ConditionRepository {

	public function save(Condition $condition){
		return $condition->save();
	}

	public function getAllForCurrentLang()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		if (!empty($language)) {
			return $language->productConditions()->lists('name','product_condition_id');
		}else{
			return array();
		}
	}
		
}
