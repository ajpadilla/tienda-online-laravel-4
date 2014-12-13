<?php namespace s4h\store\AttributeTypesLang;

use s4h\store\AttributeTypesLang\AttributeTypeLang;

/**
* 
*/
class AttributeTypeLangRepository extends AnotherClass
{
	public function getAllForLanguage($language_id)
  	{
  		return AttributeTypeLang::where('language_id','=',$language_id)->get();
  	}
}