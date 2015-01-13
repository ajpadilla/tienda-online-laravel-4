<?php namespace s4h\store\Countries;


use s4h\store\Countries\Country;
use s4h\store\States\State;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;

class CountryRepository {

	public function save(Country $country){
		return $country->save();
	}

	public function getAll(){
		return Country::all();
	}

	public function getNameForLanguage()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		if (!empty($language)) {
			return $language->countries()->lists('name','country_id');
		}else{
			return array();
		}
	}
		
	public function getId($country_id)
	{
		return Country::findOrFail($country_id);
	}

	public function getlistOfStates($country_id)
	{
		$country = $this->getId($country_id);
	 	$states = $country->states()->where('country_id', '=', $country_id)->lists('name', 'id');
	 	return $states;
	}
}