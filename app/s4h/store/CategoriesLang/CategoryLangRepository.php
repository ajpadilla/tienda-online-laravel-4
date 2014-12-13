<?php namespace s4h\store\CategoriesLang;
 
 use s4h\store\CategoriesLang\CategoryLang;
 /**
 * 
 */
 class CategoryLangRepository {
 
 	public function getAllForLanguage($language_id)
  	{
  		return CategoryLang::where('language_id','=',$language_id)->get();
  	}

 }