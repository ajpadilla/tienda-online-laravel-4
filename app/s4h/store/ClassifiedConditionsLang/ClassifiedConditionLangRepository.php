<?php namespace s4h\store\ClassifiedConditionsLang;
 
 use s4h\store\ClassifiedConditionsLang\ClassifiedConditionLang;
 /**
 * 
 */
 class ClassifiedConditionLangRepository {
 
 	public function getAllForLanguage($language_id)
  	{
  		return ClassifiedConditionLang::where('language_id','=',$language_id)->get();
  	}

 }