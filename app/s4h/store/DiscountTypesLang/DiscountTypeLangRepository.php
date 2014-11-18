<?php namespace s4h\store\DiscountTypesLang;
 
 use s4h\store\DiscountTypeLang;
 /**
 * 
 */
 class DiscountTypeLangRepository {
 	
 	public function getAllForLanguage($language_id)
	{
		return DiscountTypeLang::where('language_id','=',$language_id)->get();
	}
 }