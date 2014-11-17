<?php namespace s4h\store\ShipmentStatusLang;
  
  use s4h\store\ShipmentStatusLang\ShipmentStatusLang;

  /**
  * 
  */
  class ShipmentStatusLangRepository {

  	public function getAllForLanguage($language_id)
  	{
  		return ShipmentStatusLang::where('language_id','=',$language_id)->get();
  	}

  }	
