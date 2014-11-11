<?php namespace s4h\store\Languages;

use	 s4h\store\Languages\Language;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
* 
*/
class LanguageRepository{

	public function save(Language $language){
		return $language->save();
	}

	public function getAll(){
		return Language::all();
	}

	public function createNewLanguage($data = array())
	{
		$language = new Language;
		$language->name = $data['name'];
		$language->native_name = $data['native_name'];
		$language->iso_code = $data['iso_code'];
		$language->language_code = $data['language_code'];
		$language->date_format = $data['date_format'];
		$this->save($language);
	}
	
	public function getIsoCode($iso_code)
	{
		return Language::where('iso_code','=',$iso_code)->get();
	}

	public function returnLanguage()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		return $language;
	}

}