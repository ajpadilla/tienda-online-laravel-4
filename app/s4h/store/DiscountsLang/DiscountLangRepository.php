<?php  namespace s4h\store\DiscountsLang;

use  s4h\store\DiscountsLang\DiscountLang;


class DiscountLangRepository{
	
	public function getAllForLanguage($language_id)
	{
		return DiscountLang::where('language_id','=',$language_id)->get();
	}
}