<?php namespace s4h\store\ClassifiedsLang;

use s4h\store\ClassifiedsLang\ClassifiedsLang;

/**
* 
*/
class ClassifiedsLangRepository{

	public function getAllForLanguage($language_id)
	{
		return ClassifiedsLang::where('language_id','=',$language_id)->get();
	}

}
