<?php namespace s4h\store\Measures;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Measures\Measure;

class MeasureRepository {

	public function save(Measure $measure){
		return $measure->save();
	}

	public function getAll(){
		return Measure::all();
	}

	public function getNameForLanguage()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		return $language->measure()->lists('name','measures_id');
	}
		
}
