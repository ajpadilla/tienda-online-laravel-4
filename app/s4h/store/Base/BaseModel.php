<?php namespace s4h\store\Base;

use Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Datatable;
use Illuminate\Database\Eloquent\Collection;
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

