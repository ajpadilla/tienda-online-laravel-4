<?php namespace s4h\store\Weights;

use s4h\store\Weights\Weight;
use s4h\store\Languages\Language;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/**
* 
*/
class WeightRepository {
	
	public function getAll()
	{
		return Weight::all();
	}

	public function getNameForLanguage()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		return $language->weights()->lists('abbreviation','weight_id');
	}

}