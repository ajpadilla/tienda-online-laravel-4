<?php namespace s4h\store\ProductsLang;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\ProductsLang\ProductLang;

  /**
  * 
  */
  class ProductLangRepository {

  	public function getAllForLanguage($language_id)
  	{
  		return ProductLang::where('language_id','=',$language_id)->get();
  	}


	public function getNewProducts($quantity = 4){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		return ProductLang::whereLanguageId($language->id)->orderBy('created_at', 'DESC')->take($quantity)->get();
	}
  }	
