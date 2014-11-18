<?php namespace s4h\store\InvoiceStatusLang;
 
 use s4h\store\InvoiceStatusLang\InvoiceStatusLang;
 /**
 * 
 */
 class InvoiceStatusLangRepository {
 
 	public function getAllForLanguage($language_id)
  	{
  		return InvoiceStatusLang::where('language_id','=',$language_id)->get();
  	}

 }