<?php namespace s4h\store\ClassifiedTypesLang;
 
 use s4h\store\ClassifiedTypesLang\ClassifiedTypeLang;
 /**
 * 
 */
 class ClassifiedTypeLangRepository {
 
 	public function getAllForLanguage($language_id)
  	{
  		return ClassifiedTypeLang::where('language_id','=',$language_id)->get();
  	}

 }