<?php namespace s4h\store\ProductsLang;
  
 use s4h\store\ProductsLang\ProductLang;

  /**
  * 
  */
  class ProductLangRepository {

  	public function getAllForLanguage($language_id)
  	{
  		return ProductLang::where('language_id','=',$language_id)->get();
  	}

  }	
