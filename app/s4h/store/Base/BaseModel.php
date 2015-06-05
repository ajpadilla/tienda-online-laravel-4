<?php namespace s4h\store\Base;

use Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;

/**
* 
*/
class BaseModel extends Eloquent{

	public function getCurrentLang(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		return $language;
	}

}

